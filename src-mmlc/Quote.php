<?php

namespace Grandeljay\Dhl;

use Grandeljay\Dhl\Configuration\Group;
use RobinTheHood\ModifiedStdModule\Classes\{Configuration, CaseConverter};

class Quote
{
    private Configuration $config;
    private Country $country;
    private array $methods           = [];
    private array $boxes             = [];
    private float $weight            = 0;
    private string $weight_formatted = '';

    public function __construct(string $module)
    {
        global $order;

        if (isset($order->delivery['country'])) {
            $country = $order->delivery['country'];
        } else {
            $country_query = xtc_db_query(
                sprintf(
                    'SELECT *
                       FROM `%s`
                      WHERE `countries_id` = %s',
                    \TABLE_COUNTRIES,
                    \STORE_COUNTRY
                )
            );
            $country       = xtc_db_fetch_array($country_query);
        }

        $this->config  = new Configuration($module);
        $this->country = new Country($country);

        $shipping_weight_ideal   = $this->getConfig(Group::SHIPPING_WEIGHT . '_IDEAL');
        $shipping_weight_maximum = $this->getConfig(Group::SHIPPING_WEIGHT . '_MAX');

        $order_packer = new \Grandeljay\ShippingModuleHelper\OrderPacker();
        $order_packer->setIdealWeight($shipping_weight_ideal);
        $order_packer->setMaximumWeight($shipping_weight_maximum);
        $order_packer->packOrder();

        $this->boxes            = $order_packer->getBoxes();
        $this->weight           = $order_packer->getWeight();
        $this->weight_formatted = $order_packer->getWeightFormatted();

        $this->methods = \array_filter(
            $this->getShippingMethods(),
            function (array $method) {
                return $method['cost'] > 0;
            }
        );

        $this->setSurcharges();
    }

    private function getConfig(string $screaming_key): mixed
    {
        $camelKey = CaseConverter::screamingToCamel($screaming_key);

        if (isset($this->config->$camelKey)) {
            return $this->config->$camelKey;
        }

        return false;
    }

    public function exceedsMaximumWeight(): bool
    {
        global $order;

        if (null === $order) {
            return true;
        }

        $shipping_weight_max = $this->getConfig(Group::SHIPPING_WEIGHT . '_MAX');

        foreach ($this->boxes as $box) {
            if ($box->getWeightWithoutAttributes() >= $shipping_weight_max) {
                return true;
            }
        }

        return false;
    }

    private function getShippingMethods(): array
    {
        $methods = [];

        /** National */
        $shipping_is_national = intval(\STORE_COUNTRY) === $this->country->getCountryID();

        if ($shipping_is_national) {
            $methods[] = $this->getShippingMethodNational();
        }
        /** */

        /** International */
        $shipping_is_international = !$shipping_is_national;

        if ($shipping_is_international) {
            $premium_enabled = $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_ENABLE');

            if ('true' === $premium_enabled) {
                $methods[] = $this->getShippingMethodInternationalPremium();
            }

            $economy_enabled = $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_ENABLE');

            if ('true' === $economy_enabled) {
                $methods[] = $this->getShippingMethodInternationalEconomy();
            }
        }
        /** */

        /** Exceptions */
        if ($shipping_is_international) {
            $delivery_country_code = $this->country->getCountryCode();

            $exceptions_data = $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_DATA');
            $exceptions      = \json_decode($exceptions_data, true);

            foreach ($exceptions as $exception) {
                if ($exception['country'] !== $delivery_country_code) {
                    continue;
                }

                foreach ($methods as &$method) {
                    if ('paket-international-premium' !== $method['id']) {
                        continue;
                    }

                    $costs_old = $method['cost'];
                    $costs     = $exception['cost'];

                    $method['cost']          -= $costs_old;
                    $method['calculations'][] = [
                        'item'  => 'Exception found, resetting costs...',
                        'costs' => -1 * $costs_old,
                    ];

                    foreach ($this->boxes as $box_index => $box) {
                        $box_n     = $box_index + 1;
                        $box_count = count($this->boxes);

                        $method['cost']          += $costs;
                        $method['calculations'][] = [
                            'item'  => sprintf(
                                'Exception (%s) for box %d / %d',
                                $exception['country'],
                                $box_n,
                                $box_count
                            ),
                            'costs' => $costs,
                        ];
                    }
                }
            }
        }
        /** */

        return $methods;
    }

    private function getShippingMethodNational(): array
    {
        $method_description    = \constant(\sprintf('%s_TEXT_TITLE_DESC', \grandeljaydhl::NAME));
        $method_paket_national = [
            'id'               => 'paket-national',
            'title'            => 'Standard',
            'description'      => $method_description,
            'cost'             => 0,
            'calculations'     => [],
            'weight_formatted' => $this->weight_formatted,
        ];

        $shipping_national_costs = json_decode($this->getConfig(Group::SHIPPING_NATIONAL . '_COSTS'), true);

        asort($shipping_national_costs);

        foreach ($this->boxes as $box_index => $box) {
            foreach ($shipping_national_costs as $shipping_national_cost) {
                $weight_max  = floatval($shipping_national_cost['weight']);
                $weight_cost = floatval($shipping_national_cost['cost']);
                $box_weight  = $box->getWeightWithAttributes();
                ;

                if ($box_weight <= $weight_max) {
                    $costs_before = $method_paket_national['cost'];

                    $method_paket_national['cost']          += $weight_cost;
                    $method_paket_national['calculations'][] = [
                        'item'  => sprintf(
                            'National shipping for box %d / %d (%01.2f kg)',
                            $box_index + 1,
                            count($this->boxes),
                            $box_weight
                        ),
                        'costs' => $weight_cost,
                    ];

                    break;
                }
            }
        }

        return $method_paket_national;
    }

    private function getShippingMethodInternationalPremium(): array
    {
        $zone = $this->country->getZone();

        $method_description                 = \constant(\sprintf('%s_TEXT_TITLE_DESC', \grandeljaydhl::NAME));
        $method_paket_international_premium = [
            'id'               => 'paket-international-premium',
            'title'            => 'Premium',
            'description'      => $method_description,
            'cost'             => 0,
            'calculations'     => [],
            'weight_formatted' => $this->weight_formatted,
        ];

        /** Determine config keys for zone price */

        /** Base */
        $config_base       = $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z' . $zone . '_PRICE_BASE');
        $config_base_eu    = $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z' . $zone . '_PRICE_BASE_EU');
        $config_base_noneu = $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z' . $zone . '_PRICE_BASE_NONEU');

        /** Kilogram */
        $config_kg       = $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z' . $zone . '_PRICE_KG');
        $config_kg_eu    = $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z' . $zone . '_PRICE_KG_EU');
        $config_kg_noneu = $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z' . $zone . '_PRICE_KG_NONEU');

        /** Add costs */
        $price_base = 0;
        $price_kg   = 0;

        if (!in_array(false, [$config_base, $config_kg], true)) {
            $price_base = $config_base;
            $price_kg   = $config_kg;
        } else {
            if ($this->country->getIsEU()) {
                if (!in_array(false, [$config_base_eu, $config_kg_eu], true)) {
                    $price_base = $config_base_eu;
                    $price_kg   = $config_kg_eu;
                }
            } else {
                if (!in_array(false, [$config_base_noneu, $config_kg_noneu], true)) {
                    $price_base = $config_base_noneu;
                    $price_kg   = $config_kg_noneu;
                }
            }
        }

        foreach ($this->boxes as $box_index => $box) {
            $box_weight = $box->getWeightWithAttributes();
            ;
            $costs = $price_base + $price_kg * ceil($box_weight);

            $method_paket_international_premium['cost']          += $costs;
            $method_paket_international_premium['calculations'][] = [
                'item'  => sprintf(
                    'Base price for Zone %d (%01.2f €) + kg price (%01.2f €) for box %d / %d (%01.2f kg)',
                    $zone,
                    $price_base,
                    $price_kg,
                    $box_index + 1,
                    count($this->boxes),
                    $box_weight
                ),
                'costs' => $costs,
            ];
        }

        return $method_paket_international_premium;
    }

    private function getShippingMethodInternationalEconomy(): array
    {
        $zone = $this->country->getZone();

        $method_description                 = \constant(\sprintf('%s_TEXT_TITLE_DESC', \grandeljaydhl::NAME));
        $method_paket_international_economy = [
            'id'               => 'paket-international-economy',
            'title'            => 'Economy',
            'description'      => $method_description,
            'cost'             => 0,
            'calculations'     => [],
            'weight_formatted' => $this->weight_formatted,
        ];

        /** Determine config keys for zone price */

        /** Base */
        $config_base       = $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z' . $zone . '_PRICE_BASE');
        $config_base_eu    = $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z' . $zone . '_PRICE_BASE_EU');
        $config_base_noneu = $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z' . $zone . '_PRICE_BASE_NONEU');

        /** Kilogram */
        $config_kg       = $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z' . $zone . '_PRICE_KG');
        $config_kg_eu    = $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z' . $zone . '_PRICE_KG_EU');
        $config_kg_noneu = $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z' . $zone . '_PRICE_KG_NONEU');

        /** Add costs */
        $price_base = 0;
        $price_kg   = 0;

        if (!in_array(false, [$config_base, $config_kg], true)) {
            $price_base = $config_base;
            $price_kg   = $config_kg;
        } elseif ($this->country->getIsEU()) {
            if (!in_array(false, [$config_base_eu, $config_kg_eu], true)) {
                $price_base = $config_base_eu;
                $price_kg   = $config_kg_eu;
            }
        } else {
            if (!in_array(false, [$config_base_noneu, $config_kg_noneu], true)) {
                $price_base = $config_base_noneu;
                $price_kg   = $config_kg_noneu;
            }
        }

        foreach ($this->boxes as $box_index => $box) {
            $box_weight = $box->getWeightWithAttributes();
            ;
            $costs = $price_base + $price_kg * ceil($box_weight);

            $method_paket_international_economy['cost']          += $costs;
            $method_paket_international_economy['calculations'][] = [
                'item'  => sprintf(
                    'Base price for Zone %d (%01.2f €) + kg price (%01.2f €) for box %d / %d (%01.2f kg)',
                    $zone,
                    $price_base,
                    $price_kg,
                    $box_index + 1,
                    count($this->boxes),
                    $box_weight
                ),
                'costs' => $costs,
            ];
        }

        return $method_paket_international_economy;
    }

    private function setSurcharges(): void
    {
        /**
         * Surcharges
         */
        $surcharges_config = json_decode($this->getConfig('SURCHARGES'), true);
        $surcharges        = [];
        $surcharges_update = false;

        foreach ($this->methods as &$method) {
            $cost_before_surcharges = $method['cost'];

            foreach ($surcharges_config as $surcharge_index => $surcharge) {
                if (!empty($surcharge['duration-start']) && !empty($surcharge['duration-end'])) {
                    /** Date now */
                    $date_now = new \DateTime();

                    /** Duration start */
                    $duration_start           = new \DateTime($surcharge['duration-start']);
                    $duration_start_is_active = $date_now >= $duration_start;

                    /** Duration end */
                    $duration_end           = new \DateTime($surcharge['duration-end']);
                    $duration_end_is_active = $date_now <= $duration_end;

                    /** Automatically update duration years */
                    if ($date_now > $duration_start && $date_now > $duration_end) {
                        $new_duration_start = $duration_start->modify('+1 year');
                        $new_duration_end   = $duration_end->modify('+1 year');

                        $surcharge['duration-start'] = $new_duration_start->format('Y-m-d');
                        $surcharge['duration-end']   = $new_duration_end->format('Y-m-d');

                        $surcharges_update = true;
                    }

                    /** Duration now */
                    $duration_is_now = $duration_start_is_active && $duration_end_is_active;

                    if (!$duration_is_now) {
                        continue;
                    }
                }

                $key_per_package = sprintf('configuration[per-package-%d]', $surcharge_index);

                switch ($surcharge['type']) {
                    case 'fixed':
                        $surcharge_amount = $surcharge['surcharge'];

                        foreach ($this->boxes as $box_index => $box) {
                            $method_cost              = $method['cost'];
                            $method['cost']          += $surcharge_amount;
                            $method['calculations'][] = [
                                'item'  => sprintf(
                                    '%s (%01.2f €) for box %d / %d (%01.2f kg)',
                                    $surcharge['name'],
                                    $surcharge['surcharge'],
                                    $box_index + 1,
                                    count($this->boxes),
                                    $box->getWeightWithAttributes()
                                ),
                                'costs' => $surcharge_amount,
                            ];

                            if ('true' !== $surcharge[$key_per_package]) {
                                break;
                            }
                        }
                        break;

                    case 'percent':
                        $surcharge_amount = $cost_before_surcharges * ($surcharge['surcharge'] / 100);

                        foreach ($this->boxes as $box_index => $box) {
                            $method['cost']          += $surcharge_amount;
                            $method['calculations'][] = [
                                'item'  => sprintf(
                                    'Costs before surcharges (%01.2f €) * (%s: %01.2f %%)',
                                    $cost_before_surcharges,
                                    $surcharge['name'],
                                    $surcharge['surcharge']
                                ),
                                'costs' => $surcharge_amount,
                            ];

                            if ('true' !== $surcharge[$key_per_package]) {
                                break;
                            }
                        }
                        break;
                }
            }

            $surcharges[] = $surcharge;
        }

        /** Update surcharges option */
        if ($surcharges_update) {
            \xtc_db_query(
                sprintf(
                    'UPDATE `%s`
                        SET `configuration_value` = "%s"
                      WHERE `configuration_key`   = "%s"',
                    \TABLE_CONFIGURATION,
                    \addslashes(json_encode($surcharges)),
                    'MODULE_SHIPPING_GRANDELJAYDHL_SURCHARGES'
                )
            );
        }

        /** Pick and Pack */
        foreach ($this->methods as &$method) {
            $pick_and_pack_costs = json_decode($this->getConfig(Group::SURCHARGES . '_PICK_AND_PACK', '[]'), true);

            asort($pick_and_pack_costs);

            foreach ($this->boxes as $box_index => $box) {
                foreach ($pick_and_pack_costs as $pick_and_pack_cost) {
                    $weight_max  = floatval($pick_and_pack_cost['weight']);
                    $weight_cost = floatval($pick_and_pack_cost['cost']);
                    $box_weight  = $box->getWeightWithAttributes();
                    ;

                    if ($box_weight <= $weight_max) {
                        $cost_before = $method['cost'];

                        $method['cost']          += $weight_cost;
                        $method['calculations'][] = [
                            'item'  => sprintf(
                                'Pick and Pack (%01.2f €) for box %d / %d (%01.2f kg)',
                                $weight_cost,
                                $box_index + 1,
                                count($this->boxes),
                                $box_weight,
                            ),
                            'costs' => $weight_cost,
                        ];

                        break;
                    }
                }
            }
        }

        /** Round up */
        $surcharges_round_up    = $this->getConfig(Group::SURCHARGES . '_ROUND_UP');
        $surcharges_round_up_to = $this->getConfig(Group::SURCHARGES . '_ROUND_UP_TO');

        if ('true' === $surcharges_round_up && is_numeric($surcharges_round_up_to)) {
            $surcharges_round_up_to = (float) $surcharges_round_up_to;

            foreach ($this->methods as &$method) {
                $method_cost     = $method['cost'];
                $number_whole    = floor($method_cost);
                $number_decimals = round($method_cost - $number_whole, 2);
                $costs_to_add    = $number_whole + $surcharges_round_up_to - $method_cost;

                $round_up_to = $method_cost;

                if ($number_decimals > $surcharges_round_up_to) {
                    $round_up_to = ceil($method_cost) + $surcharges_round_up_to;
                }

                if ($number_decimals < $surcharges_round_up_to) {
                    $round_up_to = $number_whole + $surcharges_round_up_to;
                }

                $method['cost']           = $round_up_to;
                $method['calculations'][] = [
                    'item'  => sprintf(
                        'Round up to %01.2f',
                        $surcharges_round_up_to,
                    ),
                    'costs' => $costs_to_add,
                ];
            }
        }
        /** */
    }

    public function getQuote(): ?array
    {
        if (empty($this->methods) || $this->exceedsMaximumWeight()) {
            return null;
        }

        if (\class_exists('Grandeljay\ShippingConditions\Surcharges')) {
            $surcharges = new \Grandeljay\ShippingConditions\Surcharges(
                \grandeljaydhl::class,
                $this->methods
            );
            $surcharges->setSurcharges();

            $this->methods = $surcharges->getMethods();
        }

        $quote = [
            'id'      => 'grandeljaydhl',
            'module'  => \constant(\sprintf('%s_TEXT_TITLE', \grandeljaydhl::NAME)),
            'methods' => $this->methods,
        ];

        return $quote;
    }
}
