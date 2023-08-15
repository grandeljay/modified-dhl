<?php

/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

use Grandeljay\Dhl\Configuration\Group;

if (defined('TABLE_COUNTRIES') && defined('MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COUNTRY')) {
    $country_query = xtc_db_query(
        'SELECT *
           FROM `' . TABLE_COUNTRIES . '`
          WHERE `countries_id` = ' . MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COUNTRY
    );
    $country       = xtc_db_fetch_array($country_query);
}

$translations_general = array(
    /**
     * Module
     */
    'TITLE'                                                              => 'grandeljay - DHL',
    'LONG_DESCRIPTION'                                                   => 'DHL shipping method',
    'STATUS_TITLE'                                                       => 'Activate module?',
    'STATUS_DESC'                                                        => 'Enables shipping via DHL.',
    'TEXT_TITLE'                                                         => 'DHL',

    /**
     * Required for modified compatibility
     */
    'ALLOWED_TITLE'                                                      => '',
    'ALLOWED_DESC'                                                       => '',

    /**
     * Sort Order
     */
    'SORT_ORDER_TITLE'                                                   => 'Sort order',
    'SORT_ORDER_DESC'                                                    => 'Determines the sorting in the Admin and Checkout. Lowest numbers are displayed first.',

    /**
     * Debug
     */
    'DEBUG_ENABLE_TITLE'                                                 => 'Debug mode',
    'DEBUG_ENABLE_DESC'                                                  => 'Activate debug mode? Additional information is displayed, e.g. how the shipping costs were calculated. Only visible for admins.',

    /**
     * Weight
     */
    Group::SHIPPING_WEIGHT . '_START_TITLE'                              => 'Weight',
    Group::SHIPPING_WEIGHT . '_START_DESC'                               => 'Here you will find all the settings regarding packing and weight. Click on the group to open the settings.',

    Group::SHIPPING_WEIGHT . '_MAX_TITLE'                                => 'Maximum weight',
    Group::SHIPPING_WEIGHT . '_MAX_DESC'                                 => 'Maximum weight an item may have.',
    Group::SHIPPING_WEIGHT . '_IDEAL_TITLE'                              => 'Ideal weight',
    Group::SHIPPING_WEIGHT . '_IDEAL_DESC'                               => 'Target weight when calculating shipping costs, e.g. to increase transport safety.',

    Group::SHIPPING_WEIGHT . '_END_TITLE'                                => '',
    Group::SHIPPING_WEIGHT . '_END_DESC'                                 => '',

    /**
     * National
     */
    Group::SHIPPING_NATIONAL . '_START_TITLE'                            => 'National shipping',
    Group::SHIPPING_NATIONAL . '_START_DESC'                             => 'Here you will find all the settings relating to national dispatch. Click on the group to open the settings.',

    Group::SHIPPING_NATIONAL . '_COUNTRY_TITLE'                          => 'National Shipping',
    Group::SHIPPING_NATIONAL . '_COUNTRY_DESC'                           => sprintf(
        'Location of the online shop is currently %s and can be adjusted under %s.',
        $country['countries_name'] ?? 'Unknown',
        sprintf(
            '<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s -> %s</a>',
            defined('BOX_HEADING_CONFIGURATION') ? BOX_HEADING_CONFIGURATION : 'BOX_HEADING_CONFIGURATION',
            defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1',
        )
    ),
    Group::SHIPPING_NATIONAL . '_COSTS_TITLE'                            => 'National shipping costs',
    Group::SHIPPING_NATIONAL . '_COSTS_DESC'                             => 'Allocation of shipping costs for different weights.',

    Group::SHIPPING_NATIONAL . '_WEIGHT_TITLE'                           => 'Weight',
    Group::SHIPPING_NATIONAL . '_WEIGHT_DESC'                            => 'Maximum permissible weight (in kg) for this price.',
    Group::SHIPPING_NATIONAL . '_COST_TITLE'                             => 'Cost',
    Group::SHIPPING_NATIONAL . '_COST_DESC'                              => 'Shipping costs for weight in EUR.',

    Group::SHIPPING_NATIONAL . '_BUTTON_ADD'                             => 'Add',
    Group::SHIPPING_NATIONAL . '_BUTTON_APPLY'                           => 'Apply',
    Group::SHIPPING_NATIONAL . '_BUTTON_CANCEL'                          => 'Cancel',

    Group::SHIPPING_NATIONAL . '_END_TITLE'                              => '',
    Group::SHIPPING_NATIONAL . '_END_DESC'                               => '',

    /**
     * International
     */
    Group::SHIPPING_INTERNATIONAL . '_START_TITLE'                       => 'International shipping',
    Group::SHIPPING_INTERNATIONAL . '_START_DESC'                        => 'Here you will find all the settings regarding international shipping. Click on the group to open the settings.',

    /** Premium */
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_START_TITLE'               => 'Premium shipping',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_START_DESC'                => 'Here you will find all the settings regarding international permium shipping. Click on the group to open the settings.',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_ENABLE_TITLE'              => 'Activate Premium Shipping?',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_ENABLE_DESC'               => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_EU_TITLE'    => 'Zone 1 Premium Base Price (EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_NONEU_TITLE' => 'Zone 1 Premium Base Price (Non EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_EU_TITLE'      => 'Zone 1 Premium Kilogram Price (EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_NONEU_TITLE'   => 'Zone 1 Premium Kilogram Price (Non EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_BASE_TITLE'       => 'Zone 2 Premium Base Price',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_KG_TITLE'         => 'Zone 2 Premium Kilogram Price',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_EU_TITLE'    => 'Zone 3 Premium Base Price (EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_NONEU_TITLE' => 'Zone 3 Premium Base Price (Non EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_EU_TITLE'      => 'Zone 3 Premium Kilogram Price (EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_NONEU_TITLE'   => 'Zone 3 Premium Kilogram Price (Non EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_BASE_TITLE'       => 'Zone 4 Premium Base Price',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_KG_TITLE'         => 'Zone 4 Premium Kilogram Price',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_BASE_TITLE'       => 'Zone 5 Premium Base Price',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_KG_TITLE'         => 'Zone 5 Premium Kilogram Price',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_BASE_TITLE'       => 'Zone 6 Premium Base Price',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_KG_TITLE'         => 'Zone 6 Premium Kilogram Price',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_END_TITLE'                 => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_END_DESC'                  => '',

    /** Economy */
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_START_TITLE'               => 'Economy Shipping',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_START_DESC'                => 'Here you will find all the settings related to international economy shipping. Click on the group to open the settings.',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_ENABLE_TITLE'              => 'Activate Economy Shipping?',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_ENABLE_DESC'               => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_EU_TITLE'    => 'Zone 1 Economy Base Price (EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_NONEU_TITLE' => 'Zone 1 Economy Base Price (Non EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_EU_TITLE'      => 'Zone 1 Economy Price per kilogram (EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_NONEU_TITLE'   => 'Zone 1 Economy Kilogram Price (Non EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_BASE_TITLE'       => 'Zone 2 Economy Base Price',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_KG_TITLE'         => 'Zone 2 Economy Kilogram Price',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_EU_TITLE'    => 'Zone 3 Economy Base Price (EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_NONEU_TITLE' => 'Zone 3 Economy Base Price (Non EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_EU_TITLE'      => 'Zone 3 Economy Price per kilogram (EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_NONEU_TITLE'   => 'Zone 3 Economy Kilogram Price (Non EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_BASE_TITLE'       => 'Zone 4 Economy Base Price',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_KG_TITLE'         => 'Zone 4 Economy Kilogram Price',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_BASE_TITLE'       => 'Zone 5 Economy Base Price',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_KG_TITLE'         => 'Zone 5 Economy Kilogram Price',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_BASE_TITLE'       => 'Zone 6 Economy Base Price',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_KG_TITLE'         => 'Zone 6 Economy Kilogram Price',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_END_TITLE'                 => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_END_DESC'                  => '',

    Group::SHIPPING_INTERNATIONAL . '_END_TITLE'                         => '',
    Group::SHIPPING_INTERNATIONAL . '_END_DESC'                          => '',

    /**
     * Surcharges
     */
    Group::SURCHARGES . '_START_TITLE'                                   => 'Impacts',
    Group::SURCHARGES . '_START_DESC'                                    => 'Here you will find all the settings regarding the surcharges. Click on the group to open the settings.',

    Group::SURCHARGES . '_TITLE'                                         => 'Impacts',
    Group::SURCHARGES . '_DESC'                                          => '',

    Group::SURCHARGES . '_NAME_TITLE'                                    => 'Name',
    Group::SURCHARGES . '_NAME_DESC'                                     => 'Term for the serve.',
    Group::SURCHARGES . '_SURCHARGE_TITLE'                               => 'Impact',
    Group::SURCHARGES . '_SURCHARGE_DESC'                                => 'How much is the surcharge?',
    Group::SURCHARGES . '_TYPE_TITLE'                                    => 'Art',
    Group::SURCHARGES . '_TYPE_DESC'                                     => 'What kind of surcharge are we talking about?',
    Group::SURCHARGES . '_TYPE_FIXED'                                    => 'Fixed',
    Group::SURCHARGES . '_TYPE_PERCENT'                                  => 'Percentage',
    Group::SURCHARGES . '_PER_PACKAGE_TITLE'                             => 'Per package',
    Group::SURCHARGES . '_PER_PACKAGE_DESC'                              => 'The surcharge is calculated for each package.',
    Group::SURCHARGES . '_DURATION_START_TITLE'                          => 'From',
    Group::SURCHARGES . '_DURATION_START_DESC'                           => 'Optional. From when the surcharge should apply. Year numbers update automatically.',
    Group::SURCHARGES . '_DURATION_END_TITLE'                            => 'Until',
    Group::SURCHARGES . '_DURATION_END_DESC'                             => 'Optional. Until when the surcharge is to apply. Year numbers update automatically.',

    Group::SURCHARGES . '_PICK_AND_PACK_TITLE'                           => 'Pick & Pack',
    Group::SURCHARGES . '_PICK_AND_PACK_DESC'                            => 'Costs incurred in assembling and packing the order.',

    Group::SURCHARGES . '_ROUND_UP_TITLE'                                => 'Round up shipping costs?',
    Group::SURCHARGES . '_ROUND_UP_DESC'                                 => 'Allows the shipping costs to be displayed more uniformly by always rounding up the amounts (to e.g. XX.90 €).',
    Group::SURCHARGES . '_ROUND_UP_TO_TITLE'                             => 'Round up to',
    Group::SURCHARGES . '_ROUND_UP_TO_DESC'                              => 'To which decimal place should always be rounded up?',

    Group::SURCHARGES . '_END_TITLE'                                     => '',
    Group::SURCHARGES . '_END_DESC'                                      => '',
);

/**
 * Define
 */
$translations = array_merge(
    $translations_general,
);

foreach ($translations as $key => $value) {
    $constant = 'MODULE_SHIPPING_' . strtoupper(pathinfo(__FILE__, PATHINFO_FILENAME)) . '_' . $key;

    define($constant, $value);
}
