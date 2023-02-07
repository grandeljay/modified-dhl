<?php

/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 *
 * @phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
 * @phpcs:disable Squiz.Classes.ValidClassName.NotCamelCaps
 */

use Grandeljay\Dhl\{Country, Parcel};
use RobinTheHood\ModifiedStdModule\Classes\StdModule;

/**
 * Shipping methods musn't contain underscores.
 */
class grandeljaydhl extends StdModule
{
    public const NAME    = 'MODULE_SHIPPING_GRANDELJAYDHL';
    public const VERSION = '0.3.0';

    private const NAMESPACE_CONFIGURATION = '\Grandeljay\Dhl\Configuration';

    public function __construct()
    {
        parent::__construct(self::NAME);

        $this->checkForUpdate(true);

        /**
         * Debug
         */
        $this->addKey('DEBUG_ENABLE');
        /** */

        /**
         * Weight
         */
        $this->addKey('SHIPPING_WEIGHT_START');

            $this->addKey('SHIPPING_WEIGHT_MAX');
            $this->addKey('SHIPPING_WEIGHT_IDEAL');

        $this->addKey('SHIPPING_WEIGHT_END');
        /** */

        /**
         * National
         */
        $this->addKey('SHIPPING_NATIONAL_START');

            $this->addKey('SHIPPING_NATIONAL_COUNTRY');
            $this->addKey('SHIPPING_NATIONAL_COSTS');

        $this->addKey('SHIPPING_NATIONAL_END');
        /** */

        /**
         * International
         */
        $this->addKey('SHIPPING_INTERNATIONAL_START');

            /** Premium */
            $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_START');

                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_ENABLE');

                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU');
                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU');
                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU');
                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU');

                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE');
                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG');

                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU');
                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU');
                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU');
                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU');

                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE');
                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG');

                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE');
                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG');

                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE');
                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG');

            $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_END');

            /** Economy */
            $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_START');

                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_ENABLE');

                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU');
                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU');
                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU');
                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU');

                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE');
                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG');

                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU');
                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU');
                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU');
                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU');

                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE');
                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG');

                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE');
                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG');

                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE');
                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG');

            $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_END');

        $this->addKey('SHIPPING_INTERNATIONAL_END');
        /** */

        /**
         * Surcharges
         */
        $this->addKey('SURCHARGES_START');

            $this->addKey('SURCHARGES');

            $this->addKey('SURCHARGES_PICK_AND_PACK');

            $this->addKey('SURCHARGES_ROUND_UP');
            $this->addKey('SURCHARGES_ROUND_UP_TO');

        $this->addKey('SURCHARGES_END');
        /** */
    }

    public function install()
    {
        parent::install();

        /**
         * Required for modified compatibility
         */
        $this->addConfiguration('ALLOWED', '', 6, 1);
        /** */

        /**
         * Debug
         */
        $this->addConfigurationSelect('DEBUG_ENABLE', 'true', 6, 1);
        /** */

        /**
         * Weight
         */
        $this->addConfiguration('SHIPPING_WEIGHT_START', $this->getConfig('SHIPPING_WEIGHT_START_TITLE'), 6, 1, self::NAMESPACE_CONFIGURATION . '\Group::weightStart(');

            $this->addConfiguration('SHIPPING_WEIGHT_MAX', 31.5, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
            $this->addConfiguration('SHIPPING_WEIGHT_IDEAL', 15, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');

        $this->addConfiguration('SHIPPING_WEIGHT_END', '', 6, 1, self::NAMESPACE_CONFIGURATION . '\Group::weightStart(');
        /** */

        /**
         * National
         */
        $this->addConfiguration('SHIPPING_NATIONAL_START', $this->getConfig('SHIPPING_NATIONAL_START_TITLE'), 6, 1, self::NAMESPACE_CONFIGURATION . '\Group::nationalStart(');

            $prices_national = json_encode(
                array(
                    array(
                        'weight' => 20,
                        'cost'   => 4.06,
                    ),
                    array(
                        'weight' => 31.5,
                        'cost'   => 4.90,
                    ),
                ),
            );

            $this->addConfiguration('SHIPPING_NATIONAL_COUNTRY', STORE_COUNTRY, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::nationalCountry(');
            $this->addConfiguration('SHIPPING_NATIONAL_COSTS', $prices_national, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::nationalCosts(');

        $this->addConfiguration('SHIPPING_NATIONAL_END', '', 6, 1, self::NAMESPACE_CONFIGURATION . '\Group::nationalEnd(');
        /** */

        /**
         * International
         */
        $this->addConfiguration('SHIPPING_INTERNATIONAL_START', $this->getConfig('SHIPPING_INTERNATIONAL_START_TITLE'), 6, 1, self::NAMESPACE_CONFIGURATION . '\Group::internationalStart(');

            /** Premium */
            $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_START', $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_START_TITLE'), 6, 1, self::NAMESPACE_CONFIGURATION . '\Group::internationalPremiumStart(');

                $this->addConfigurationSelect('SHIPPING_INTERNATIONAL_PREMIUM_ENABLE', 'true', 6, 1);

                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU', 10.44, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU', 19.40, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU', 0.64, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU', 1.00, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE', 10.76, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG', 0.75, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU', 10.97, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU', 17.79, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU', 0.85, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU', 1.81, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_END', '', 6, 1, self::NAMESPACE_CONFIGURATION . '\Group::internationalPremiumEnd(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE', 24.45, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG', 2.70, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE', 26.30, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG', 6.00, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE', 35.90, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG', 7.30, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');

            $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_END', '', 6, 1, self::NAMESPACE_CONFIGURATION . '\Group::internationalPremiumEnd(');

            /** Economy */
            $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_START', $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_START_TITLE'), 6, 1, self::NAMESPACE_CONFIGURATION . '\Group::internationalEconomyStart(');

                $this->addConfigurationSelect('SHIPPING_INTERNATIONAL_ECONOMY_ENABLE', 'false', 6, 1);

                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU', 10.15, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU', 14.48, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU', 0.70, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU', 0.27, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE', 10.70, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG', 0.80, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU', 10.90, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU', 13.90, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU', 1.00, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU', 1.00, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE', 23.80, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG', 1.40, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE', 26.30, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG', 3.30, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE', 31.85, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG', 3.20, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumber(');

            $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_END', '', 6, 1, self::NAMESPACE_CONFIGURATION . '\Group::internationalEconomyEnd(');

        $this->addConfiguration('SHIPPING_INTERNATIONAL_END', '', 6, 1, self::NAMESPACE_CONFIGURATION . '\Group::internationalEnd(');
        /** */

        /**
         * Surcharges
         */
        $this->addConfiguration('SURCHARGES_START', $this->getConfig('SURCHARGES_START_TITLE'), 6, 1, self::NAMESPACE_CONFIGURATION . '\Group::surchargesStart(');

            $surcharges = json_encode(
                array(
                    array(
                        'name'                         => 'Energiezuschlag',
                        'surcharge'                    => 3.75,
                        'type'                         => 'percent',
                        'configuration[per-package-0]' => 'false',
                    ),
                    array(
                        'name'                         => 'Maut',
                        'surcharge'                    => 0.12,
                        'type'                         => 'fixed',
                        'configuration[per-package-1]' => 'true',
                    ),
                    array(
                        'name'                         => 'Peak',
                        'surcharge'                    => 4.90,
                        'type'                         => 'fixed',
                        'configuration[per-package-2]' => 'false',
                        'duration-start'               => date('Y') . '-10-31',
                        'duration-end'                 => date('Y') + 1 . '-01-15',
                    ),
                )
            );

            $this->addConfiguration('SURCHARGES', $surcharges, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::surcharges(');

            $pick_and_pack = json_encode(
                array(
                    array(
                        'weight' => 1.00,
                        'cost'   => 1.30,
                    ),
                    array(
                        'weight' => 5.00,
                        'cost'   => 1.60,
                    ),
                    array(
                        'weight' => 10.00,
                        'cost'   =>  2.00,
                    ),
                    array(
                        'weight' => 20.00,
                        'cost'   =>  2.60,
                    ),
                    array(
                        'weight' => 60.00,
                        'cost'   =>  3.00,
                    ),
                ),
            );

            $this->addConfiguration('SURCHARGES_PICK_AND_PACK', $pick_and_pack, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::surchargesPickAndPack(');

            $this->addConfigurationSelect('SURCHARGES_ROUND_UP', 'true', 6, 1);
            $this->addConfiguration('SURCHARGES_ROUND_UP_TO', 0.90, 6, 1, self::NAMESPACE_CONFIGURATION . '\Field::inputNumberRoundUp(');

        $this->addConfiguration('SURCHARGES_END', '', 6, 1, self::NAMESPACE_CONFIGURATION . '\Group::surchargesEnd(');
        /** */
    }

    protected function updateSteps()
    {
        if (-1 === version_compare($this->getVersion(), self::VERSION)) {
            $this->setVersion(self::VERSION);

            return self::UPDATE_SUCCESS;
        }

        return self::UPDATE_NOTHING;
    }

    public function remove()
    {
        parent::remove();

        /**
         * Required for modified compatibility
         */
        $this->deleteConfiguration('ALLOWED');
        /** */

        /**
         * Debug
         */
        $this->deleteConfiguration('DEBUG_ENABLE');
        /** */

        /**
         * Weight
         */
        $this->deleteConfiguration('SHIPPING_WEIGHT_START');
        $this->deleteConfiguration('SHIPPING_WEIGHT_MAX');
        $this->deleteConfiguration('SHIPPING_WEIGHT_IDEAL');
        $this->deleteConfiguration('SHIPPING_WEIGHT_END');
        /** */

        /**
         * National
         */
        $this->deleteConfiguration('SHIPPING_NATIONAL_START');
        $this->deleteConfiguration('SHIPPING_NATIONAL_COUNTRY');
        $this->deleteConfiguration('SHIPPING_NATIONAL_COSTS');
        $this->deleteConfiguration('SHIPPING_NATIONAL_END');
        /** */

        /**
         * International
         */
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_START');

            /** Premium */
            $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_START');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_ENABLE');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG');

            $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_END');

            /** Economy */
            $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_START');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_ENABLE');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE');
                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG');

            $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_END');

        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_END');
        /** */

        /**
         * Surcharges
         */
        $this->deleteConfiguration('SURCHARGES_START');

            $this->deleteConfiguration('SURCHARGES');

            $this->deleteConfiguration('SURCHARGES_PICK_AND_PACK');

            $this->deleteConfiguration('SURCHARGES_ROUND_UP');
            $this->deleteConfiguration('SURCHARGES_ROUND_UP_TO');

        $this->deleteConfiguration('SURCHARGES_END');
        /** */
    }

    public function quote()
    {
        global $order;

        $country_delivery = new Country($order->delivery['country']);
        $methods          = array();

        /**
         * Weight
         */
        /** Maximum */
        foreach ($order->products as $product) {
            if ($product['weight'] >= $this->getConfig('SHIPPING_WEIGHT_MAX')) {
                return false;
            }
        }
        /** */

        /**
         * Amount of boxes
         */
        $boxes                   = array();
        $box                     = new Parcel();
        $grandeljay_total_weight = 0;

        foreach ($order->products as $product) {
            for ($i = 1; $i <= $product['quantity']; $i++) {
                /** Create a new box */
                $box_weight     = $box->getWeight();
                $product_weight = $product['weight'];

                if ($box_weight + $product_weight > $this->getConfig('SHIPPING_WEIGHT_IDEAL')) {
                    $boxes[] = $box;
                    $box     = new Parcel();
                }

                $box->addProduct($product);

                $grandeljay_total_weight += $product_weight;
            }
        }

        $boxes[] = $box;
        $box     = new Parcel();
        /** */

        /**
         * Shipping costs
         */

        /** National */
        $shipping_is_national = intval(STORE_COUNTRY) === $country_delivery->getCountryID();

        if ($shipping_is_national) {
            $method_paket_national = array(
                'id'    => 'paket-national',
                'title' => 'DHL Paket',
                'cost'  => 0,
                'debug' => array(
                    'calculations' => array(),
                ),
            );

            $shipping_national_costs = json_decode($this->getConfig('SHIPPING_NATIONAL_COSTS'), true);

            asort($shipping_national_costs);

            foreach ($boxes as $box_index => $box) {
                foreach ($shipping_national_costs as $shipping_national_cost) {
                    $weight_max  = floatval($shipping_national_cost['weight']);
                    $weight_cost = floatval($shipping_national_cost['cost']);

                    if ($box['weight'] <= $weight_max) {
                        $costs_before = $method_paket_national['cost'];

                        $method_paket_national['cost']                   += $weight_cost;
                        $method_paket_national['debug']['calculations'][] = sprintf(
                            'Costs (%01.2f €) + National shipping (%01.2f €) for box %d / %d (%01.2f kg) = %01.2f €',
                            $costs_before,
                            $weight_cost,
                            $box_index + 1,
                            count($boxes),
                            $box['weight'],
                            $method_paket_national['cost']
                        );

                        break;
                    }
                }
            }

            $methods[] = $method_paket_national;
        }

        /** International */
        $shipping_is_international = !$shipping_is_national;

        if ($shipping_is_international) {
            $zone = $country_delivery->getZone();

            /**
             * Premium
             */
            if ('true' === $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_ENABLE')) {
                $method_paket_international_premium = array(
                    'id'    => 'paket-international-premium',
                    'title' => 'DHL Paket (Premium)',
                    'cost'  => 0,
                    'debug' => array(
                        'calculations' => array(),
                    ),
                );

                /** Determine config keys for zone price */

                /** Base */
                $config_base       = $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_Z' . $zone . '_PRICE_BASE', false);
                $config_base_eu    = $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_Z' . $zone . '_PRICE_BASE_EU', false);
                $config_base_noneu = $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_Z' . $zone . '_PRICE_BASE_NONEU', false);

                /** Kilogram */
                $config_kg       = $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_Z' . $zone . '_PRICE_KG', false);
                $config_kg_eu    = $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_Z' . $zone . '_PRICE_KG_EU', false);
                $config_kg_noneu = $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_Z' . $zone . '_PRICE_KG_NONEU', false);

                /** Add costs */
                $price_base = 0;
                $price_kg   = 0;

                if (!in_array(false, array($config_base, $config_kg), true)) {
                    $price_base = $config_base;
                    $price_kg   = $config_kg;
                } else {
                    if ($country_delivery->getIsEU()) {
                        if (!in_array(false, array($config_base_eu, $config_kg_eu), true)) {
                            $price_base = $config_base_eu;
                            $price_kg   = $config_kg_eu;
                        }
                    } else {
                        if (!in_array(false, array($config_base_noneu, $config_kg_noneu), true)) {
                            $price_base = $config_base_noneu;
                            $price_kg   = $config_kg_noneu;
                        }
                    }
                }

                foreach ($boxes as $box_index => $box) {
                    $costs_before = $method_paket_international_premium['cost'];

                    $method_paket_international_premium['cost']                   += $price_base + $price_kg * ceil($box['weight']);
                    $method_paket_international_premium['debug']['calculations'][] = sprintf(
                        'Costs (%01.2f €) + Base price for Zone %d (%01.2f €) + kg price (%01.2f €) for box %d / %d (%01.2f kg) = %01.2f €',
                        $costs_before,
                        $zone,
                        $price_base,
                        $price_kg,
                        $box_index + 1,
                        count($boxes),
                        $box['weight'],
                        $method_paket_international_premium['cost']
                    );
                }

                $methods[] = $method_paket_international_premium;
            }

            /**
             * Economy
             */
            if ('true' === $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_ENABLE')) {
                $method_paket_international_economy = array(
                    'id'    => 'paket-international-economy',
                    'title' => 'DHL Paket (Economy)',
                    'cost'  => 0,
                    'debug' => array(
                        'calculations' => array(),
                    ),
                );

                /** Determine config keys for zone price */

                /** Base */
                $config_base       = $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_Z' . $zone . '_PRICE_BASE', false);
                $config_base_eu    = $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_Z' . $zone . '_PRICE_BASE_EU', false);
                $config_base_noneu = $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_Z' . $zone . '_PRICE_BASE_NONEU', false);

                /** Kilogram */
                $config_kg       = $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_Z' . $zone . '_PRICE_KG', false);
                $config_kg_eu    = $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_Z' . $zone . '_PRICE_KG_EU', false);
                $config_kg_noneu = $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_Z' . $zone . '_PRICE_KG_NONEU', false);

                /** Add costs */
                $price_base = 0;
                $price_kg   = 0;

                if (!in_array(false, array($config_base, $config_kg), true)) {
                    $price_base = $config_base;
                    $price_kg   = $config_kg;
                } elseif ($country_delivery->getIsEU()) {
                    if (!in_array(false, array($config_base_eu, $config_kg_eu), true)) {
                        $price_base = $config_base_eu;
                        $price_kg   = $config_kg_eu;
                    }
                } else {
                    if (!in_array(false, array($config_base_noneu, $config_kg_noneu), true)) {
                        $price_base = $config_base_noneu;
                        $price_kg   = $config_kg_noneu;
                    }
                }

                foreach ($boxes as $box_index => $box) {
                    $costs_before = $method_paket_international_economy['cost'];

                    $method_paket_international_economy['cost']                   += $price_base + $price_kg * ceil($box['weight']);
                    $method_paket_international_economy['debug']['calculations'][] = sprintf(
                        'Costs (%01.2f €) + Base price for Zone %d (%01.2f €) + kg price (%01.2f €) for box %d / %d (%01.2f kg) = %01.2f €',
                        $costs_before,
                        $zone,
                        $price_base,
                        $price_kg,
                        $box_index + 1,
                        count($boxes),
                        $box['weight'],
                        $method_paket_international_economy['cost']
                    );
                }

                $methods[] = $method_paket_international_economy;
            }
        }

        /**
         * Surcharges
         */
        $surcharges_config = json_decode($this->getConfig('SURCHARGES'), true);
        $surcharges        = array();
        $surcharges_update = false;

        foreach ($methods as &$method) {
            $cost_before_surcharges = $method['cost'];

            foreach ($surcharges_config as $surcharge_index => $surcharge) {
                if (!empty($surcharge['duration-start']) && !empty($surcharge['duration-end'])) {
                    /** Date now */
                    $date_now = new DateTime();

                    /** Duration start */
                    $duration_start           = new DateTime($surcharge['duration-start']);
                    $duration_start_is_active = $date_now >= $duration_start;

                    /** Duration end */
                    $duration_end           = new DateTime($surcharge['duration-end']);
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

                        foreach ($boxes as $box_index => $box) {
                            $method_cost                       = $method['cost'];
                            $method['cost']                   += $surcharge_amount;
                            $method['debug']['calculations'][] = sprintf(
                                'Costs (%01.2f €) + %s (%01.2f €) for box %d / %d (%01.2f kg) = %01.2f €',
                                $method_cost,
                                $surcharge['name'],
                                $surcharge['surcharge'],
                                $box_index + 1,
                                count($boxes),
                                $box['weight'],
                                $method['cost']
                            );

                            if ('true' !== $surcharge[$key_per_package]) {
                                break;
                            }
                        }
                        break;

                    case 'percent':
                        $surcharge_amount = $cost_before_surcharges * ($surcharge['surcharge'] / 100);

                        foreach ($boxes as $box_index => $box) {
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
            xtc_db_query(
                sprintf(
                    'UPDATE `%s`
                        SET `configuration_value` = "%s"
                      WHERE `configuration_key`   = "%s"',
                    TABLE_CONFIGURATION,
                    addslashes(json_encode($surcharges)),
                    'MODULE_SHIPPING_GRANDELJAYDHL_SURCHARGES'
                )
            );
        }

        /** Pick and Pack */
        foreach ($methods as &$method) {
            $pick_and_pack_costs = json_decode($this->getConfig('SURCHARGES_PICK_AND_PACK', '[]'), true);

            asort($pick_and_pack_costs);

            foreach ($boxes as $box_index => $box) {
                foreach ($pick_and_pack_costs as $pick_and_pack_cost) {
                    $weight_max  = floatval($pick_and_pack_cost['weight']);
                    $weight_cost = floatval($pick_and_pack_cost['cost']);

                    if ($box['weight'] <= $weight_max) {
                        $cost_before = $method['cost'];

                        $method['cost']                   += $weight_cost;
                        $method['debug']['calculations'][] = sprintf(
                            'Costs (%01.2f €) + Pick and Pack (%01.2f €) for box %d / %d (%01.2f kg) = %01.2f €',
                            $cost_before,
                            $weight_cost,
                            $box_index + 1,
                            count($boxes),
                            $box['weight'],
                            $method['cost']
                        );

                        break;
                    }
                }
            }
        }

        /** Round up */
        $surcharges_round_up_to = $this->getConfig('SURCHARGES_ROUND_UP');

        if ('true' === $surcharges_round_up_to && is_numeric($surcharges_round_up_to)) {
            $surcharges_round_up_to = (float) $surcharges_round_up_to;

            foreach ($methods as &$method) {
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

        /** Debug mode */
        $debug_is_enabled = $this->getConfig('DEBUG_ENABLE');
        $user_is_admin    = isset($_SESSION['customers_status']['customers_status_id']) && 0 === (int) $_SESSION['customers_status']['customers_status_id'];

        if ('true' === $debug_is_enabled && $user_is_admin) {
            foreach ($methods as &$method) {
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
        /** */

        /**
         * Finish up
         */

        /** Weight string */
        $boxes_weight = array();

        foreach ($boxes as $box) {
            $key = $box['weight'] . ' kg';

            if (isset($boxes_weight[$key])) {
                $boxes_weight[$key]++;
            } else {
                $boxes_weight[$key] = 1;
            }
        }

        $boxes_weight_unique = array_unique($boxes_weight);

        arsort($boxes_weight_unique);

        $boxes_weight_text = array();

        foreach ($boxes_weight_unique as $weight_text => $quantity) {
            preg_match('/[\d+\.]+/', $weight_text, $weight_matches);

            $weight = round($weight_matches[0], 2) . ' kg';

            $boxes_weight_text[] = sprintf(
                '%dx %s',
                $quantity,
                $weight
            );
        }

        if ('true' !== $debug_is_enabled || !$user_is_admin) {
            $boxes_weight_text = array(
                sprintf(
                    '%s kg',
                    round($grandeljay_total_weight, 2)
                ),
            );
        }

        /** Quote */
        $quote = array(
            'id'      => $this->code,
            'module'  => sprintf(
                'DHL Paket (%s)',
                implode(', ', $boxes_weight_text)
            ),
            'methods' => $methods,
        );

        return $quote;
    }
}
