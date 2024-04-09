<?php

namespace Grandeljay\Dhl;

use Grandeljay\Dhl\Configuration\Group;
use RobinTheHood\ModifiedStdModule\Classes\{Configuration, CaseConverter};

class Quote
{
    private Configuration $config;
    private Country $country;
    private float $total_weight = 0;
    private array $boxes        = [];
    private array $methods      = [];

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
                    TABLE_COUNTRIES,
                    STORE_COUNTRY
                )
            );
            $country       = xtc_db_fetch_array($country_query);
        }

        $this->config  = new Configuration($module);
        $this->country = new Country($country);
        $this->boxes   = $this->getBoxes();
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

        foreach ($order->products as $product) {
            if ($product['weight'] >= $shipping_weight_max) {
                return true;
            }
        }

        return false;
    }

    public function getBoxes(): array
    {
        global $order;

        $boxes                 = [];
        $shipping_weight_ideal = $this->getConfig(Group::SHIPPING_WEIGHT . '_IDEAL');

        if (null === $order) {
            return $boxes;
        }

        foreach ($order->products as $product) {
            for ($i = 1; $i <= $product['quantity']; $i++) {
                $product_weight = (float) $product['weight'];

                /** Find a box empty enough to fit product */
                foreach ($boxes as &$box) {
                    $box_weight          = $box->getWeight();
                    $box_can_fit_product = $box_weight + $product_weight < $shipping_weight_ideal;

                    if ($box_can_fit_product) {
                        $box->addProduct($product);

                        continue 2;
                    }
                }

                /** Break the reference binding so $box can be assigned a new value */
                unset($box);

                /** Add product to a new box */
                $box = new Parcel();
                $box->addProduct($product);

                /** Add box to list */
                $boxes[] = $box;
            }
        }

        $this->total_weight = 0;

        foreach ($boxes as $box) {
            $this->total_weight += $box->getWeight();
        }

        return $boxes;
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

                    $method['debug']['calculations'][] = sprintf(
                        'Exception found for %s. Cost has changed from %s to %s.',
                        $exception['country'],
                        $method['cost'],
                        $exception['cost']
                    );
                    $method['cost']                    = $exception['cost'];
                }
            }
        }
        /** */

        return $methods;
    }

    private function getShippingMethodNational(): array
    {
        $text_title                    = constant(\grandeljaydhl::NAME . '_TEXT_TITLE');
        $shipping_national_start_title = constant(\grandeljaydhl::NAME . '_' . Group::SHIPPING_NATIONAL . '_START_TITLE');

        $method_paket_national = [
            'id'    => 'paket-national',
            'title' => sprintf(
                '<strong>%s</strong><br>%s',
                $text_title,
                $shipping_national_start_title
            ),
            'cost'  => 0,
            'debug' => [
                'calculations' => [],
            ],
        ];

        $shipping_national_costs = json_decode($this->getConfig(Group::SHIPPING_NATIONAL . '_COSTS'), true);

        asort($shipping_national_costs);

        foreach ($this->boxes as $box_index => $box) {
            foreach ($shipping_national_costs as $shipping_national_cost) {
                $weight_max  = floatval($shipping_national_cost['weight']);
                $weight_cost = floatval($shipping_national_cost['cost']);
                $box_weight  = $box->getWeight();

                if ($box_weight <= $weight_max) {
                    $costs_before = $method_paket_national['cost'];

                    $method_paket_national['cost']                   += $weight_cost;
                    $method_paket_national['debug']['calculations'][] = sprintf(
                        'Costs (%01.2f €) + National shipping (%01.2f €) for box %d / %d (%01.2f kg) = %01.2f €',
                        $costs_before,
                        $weight_cost,
                        $box_index + 1,
                        count($this->boxes),
                        $box_weight,
                        $method_paket_national['cost']
                    );

                    break;
                }
            }
        }

        return $method_paket_national;
    }

    private function getShippingMethodInternationalPremium(): array
    {
        $zone = $this->country->getZone();

        $text_title                           = constant(\grandeljaydhl::NAME . '_TEXT_TITLE');
        $shipping_international_title         = constant(\grandeljaydhl::NAME . '_' . Group::SHIPPING_INTERNATIONAL . '_START_TITLE');
        $shipping_international_premium_title = constant(\grandeljaydhl::NAME . '_' . Group::SHIPPING_INTERNATIONAL . '_PREMIUM_START_TITLE');

        $method_paket_international_premium = [
            'id'    => 'paket-international-premium',
            'title' => sprintf(
                '<strong>%s</strong><br>%s (%s)',
                $text_title,
                $shipping_international_title,
                $shipping_international_premium_title
            ),
            'cost'  => 0,
            'debug' => [
                'calculations' => [],
            ],
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
            $costs_before = $method_paket_international_premium['cost'];
            $box_weight   = $box->getWeight();

            $method_paket_international_premium['cost']                   += $price_base + $price_kg * ceil($box_weight);
            $method_paket_international_premium['debug']['calculations'][] = sprintf(
                'Costs (%01.2f €) + Base price for Zone %d (%01.2f €) + kg price (%01.2f €) for box %d / %d (%01.2f kg) = %01.2f €',
                $costs_before,
                $zone,
                $price_base,
                $price_kg,
                $box_index + 1,
                count($this->boxes),
                $box_weight,
                $method_paket_international_premium['cost']
            );
        }

        return $method_paket_international_premium;
    }

    private function getShippingMethodInternationalEconomy(): array
    {
        $zone = $this->country->getZone();

        $text_title                           = constant(\grandeljaydhl::NAME . '_TEXT_TITLE');
        $shipping_international_title         = constant(\grandeljaydhl::NAME . '_' . Group::SHIPPING_INTERNATIONAL . '_START_TITLE');
        $shipping_international_economy_title = constant(\grandeljaydhl::NAME . '_' . Group::SHIPPING_INTERNATIONAL . '_ECONOMY_START_TITLE');

        $method_paket_international_economy = [
            'id'    => 'paket-international-economy',
            'title' => sprintf(
                '<strong>%s</strong><br>%s (%s)',
                $text_title,
                $shipping_international_title,
                $shipping_international_economy_title
            ),
            'cost'  => 0,
            'debug' => [
                'calculations' => [],
            ],
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
            $costs_before = $method_paket_international_economy['cost'];
            $box_weight   = $box->getWeight();

            $method_paket_international_economy['cost']                   += $price_base + $price_kg * ceil($box_weight);
            $method_paket_international_economy['debug']['calculations'][] = sprintf(
                'Costs (%01.2f €) + Base price for Zone %d (%01.2f €) + kg price (%01.2f €) for box %d / %d (%01.2f kg) = %01.2f €',
                $costs_before,
                $zone,
                $price_base,
                $price_kg,
                $box_index + 1,
                count($this->boxes),
                $box_weight,
                $method_paket_international_economy['cost']
            );
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
                            $method_cost                       = $method['cost'];
                            $method['cost']                   += $surcharge_amount;
                            $method['debug']['calculations'][] = sprintf(
                                'Costs (%01.2f €) + %s (%01.2f €) for box %d / %d (%01.2f kg) = %01.2f €',
                                $method_cost,
                                $surcharge['name'],
                                $surcharge['surcharge'],
                                $box_index + 1,
                                count($this->boxes),
                                $box->getWeight(),
                                $method['cost']
                            );

                            if ('true' !== $surcharge[$key_per_package]) {
                                break;
                            }
                        }
                        break;

                    case 'percent':
                        $surcharge_amount = $cost_before_surcharges * ($surcharge['surcharge'] / 100);

                        foreach ($this->boxes as $box_index => $box) {
                            $method['cost']                   += $surcharge_amount;
                            $method['debug']['calculations'][] = sprintf(
                                'Costs before surcharges (%01.2f €) * (%s: %01.2f %% (%01.2f €)) = %01.2f €',
                                $cost_before_surcharges,
                                $surcharge['name'],
                                $surcharge['surcharge'],
                                $surcharge_amount,
                                $method['cost']
                            );

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
                    $box_weight  = $box->getWeight();

                    if ($box_weight <= $weight_max) {
                        $cost_before = $method['cost'];

                        $method['cost']                   += $weight_cost;
                        $method['debug']['calculations'][] = sprintf(
                            'Costs (%01.2f €) + Pick and Pack (%01.2f €) for box %d / %d (%01.2f kg) = %01.2f €',
                            $cost_before,
                            $weight_cost,
                            $box_index + 1,
                            count($this->boxes),
                            $box_weight,
                            $method['cost']
                        );

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

                $round_up_to = $method_cost;

                if ($number_decimals > $surcharges_round_up_to) {
                    $round_up_to = ceil($method_cost) + $surcharges_round_up_to;
                }

                if ($number_decimals < $surcharges_round_up_to) {
                    $round_up_to = $number_whole + $surcharges_round_up_to;
                }

                $method['debug']['calculations'][] = sprintf(
                    'Costs (%01.2f €) round up to %01.2f = %01.2f',
                    $method_cost,
                    $surcharges_round_up_to,
                    $round_up_to
                );

                $method['cost'] = $round_up_to;
            }
        }
        /** */
    }

    private function getNameBoxWeight(): string
    {
        $debug_is_enabled = $this->getConfig('DEBUG_ENABLE');
        $user_is_admin    = isset($_SESSION['customers_status']['customers_status_id']) && 0 === (int) $_SESSION['customers_status']['customers_status_id'];

        if ('true' === $debug_is_enabled && $user_is_admin) {
            foreach ($this->methods as &$method) {
                ob_start();
                ?>
                <br /><br />

                <h3>Debug mode</h3>

                <?php foreach ($method['debug']['calculations'] as $calculation) { ?>
                    <p><?= $calculation ?></p>
                <?php } ?>
                <?php
                $method['title'] .= ob_get_clean();
            }
        }

        $boxes_weight = [];

        foreach ($this->boxes as $box) {
            $key = $box->getWeight() . ' kg';

            if (isset($boxes_weight[$key])) {
                $boxes_weight[$key]++;
            } else {
                $boxes_weight[$key] = 1;
            }
        }

        $boxes_weight_text = [];

        foreach ($boxes_weight as $weight_text => $quantity) {
            preg_match('/[\d+\.]+/', $weight_text, $weight_matches);

            $weight = round($weight_matches[0], 2) . ' kg';

            $boxes_weight_text[] = sprintf(
                '%dx %s',
                $quantity,
                $weight
            );
        }

        if ('true' !== $debug_is_enabled || !$user_is_admin) {
            $boxes_weight_text = [
                sprintf(
                    '%s kg',
                    round($this->total_weight, 2)
                ),
            ];
        }

        return implode(', ', $boxes_weight_text);
    }

    public function getQuote(): ?array
    {
        if (empty($this->methods) || $this->exceedsMaximumWeight()) {
            return null;
        }

        $quote = [
            'id'      => 'grandeljaydhl',
            'module'  => sprintf(
                'DHL (%s)',
                $this->getNameBoxWeight()
            ),
            'methods' => $this->methods,
        ];

        return $quote;
    }
}
