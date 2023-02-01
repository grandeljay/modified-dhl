<?php

/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

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
    'TITLE'                                                    => 'grandeljay - DHL',
    'LONG_DESCRIPTION'                                         => 'DHL shipping method',
    'STATUS_TITLE'                                             => 'Activate module?',
    'STATUS_DESC'                                              => 'Enables shipping via DHL.',
    'TEXT_TITLE'                                               => 'DHL',

    /**
     * Required for modified compatibility
     */
    'ALLOWED_TITLE'                                            => '',
    'ALLOWED_DESC'                                             => '',
    /** */

    /**
     * Debug
     */
    'DEBUG_ENABLE_TITLE'                                       => 'Debug mode',
    'DEBUG_ENABLE_DESC'                                        => 'Activate debug mode? Additional information is displayed, e.g. how the shipping costs were calculated. Only visible for admins.',
    /** */

    /**
     * Maximum weight
     */
    'SHIPPING_MAX_WEIGHT_TITLE'                                => 'Maximum weight',
    'SHIPPING_MAX_WEIGHT_DESC'                                 => sprintf(
        'Maximum weight an item may have. Overrides the %s option.',
        sprintf(
            '<a href="/' . DIR_ADMIN . 'configuration.php?gID=7">%s</a>',
            defined('SHIPPING_MAX_WEIGHT_TITLE') ? SHIPPING_MAX_WEIGHT_TITLE : 'SHIPPING_MAX_WEIGHT',
        )
    ),
    /** */

    /**
     * National
     */
    'SHIPPING_NATIONAL_START_TITLE'                            => 'National shipping',
    'SHIPPING_NATIONAL_START_DESC'                             => 'Here you will find all the settings relating to national dispatch. Click on the group to open the settings.',

    'SHIPPING_NATIONAL_COUNTRY_TITLE'                          => 'National Shipping',
    'SHIPPING_NATIONAL_COUNTRY_DESC'                           => sprintf(
        'Location of the online shop is currently %s and can be adjusted under %s.',
        $country['countries_name'] ?? 'Unknown',
        sprintf(
            '<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s -> %s</a>',
            defined('BOX_HEADING_CONFIGURATION') ? BOX_HEADING_CONFIGURATION : 'BOX_HEADING_CONFIGURATION',
            defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1',
        )
    ),
    'SHIPPING_NATIONAL_COSTS_TITLE'                            => 'National shipping costs',
    'SHIPPING_NATIONAL_COSTS_DESC'                             => 'Allocation of shipping costs for different weights.',

    'SHIPPING_NATIONAL_WEIGHT_TITLE'                           => 'Weight',
    'SHIPPING_NATIONAL_WEIGHT_DESC'                            => 'Maximum permissible weight (in kg) for this price.',
    'SHIPPING_NATIONAL_COST_TITLE'                             => 'Cost',
    'SHIPPING_NATIONAL_COST_DESC'                              => 'Shipping costs for weight in EUR.',

    'SHIPPING_NATIONAL_BUTTON_ADD'                             => 'Add',
    'SHIPPING_NATIONAL_BUTTON_APPLY'                           => 'Apply',
    'SHIPPING_NATIONAL_BUTTON_CANCEL'                          => 'Cancel',

    'SHIPPING_NATIONAL_END_TITLE'                              => '',
    'SHIPPING_NATIONAL_END_DESC'                               => '',

    /**
     * International
     */
    'SHIPPING_INTERNATIONAL_START_TITLE'                       => 'International shipping',
    'SHIPPING_INTERNATIONAL_START_DESC'                        => 'Here you will find all the settings regarding international shipping. Click on the group to open the settings.',

    /** Premium */
    'SHIPPING_INTERNATIONAL_PREMIUM_START_TITLE'               => 'Premium shipping',
    'SHIPPING_INTERNATIONAL_PREMIUM_START_DESC'                => 'Here you will find all the settings regarding international permium shipping. Click on the group to open the settings.',

    'SHIPPING_INTERNATIONAL_PREMIUM_ENABLE_TITLE'              => 'Activate Premium Shipping?',
    'SHIPPING_INTERNATIONAL_PREMIUM_ENABLE_DESC'               => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU_TITLE'    => 'Zone 1 Premium Base Price (EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU_TITLE' => 'Zone 1 Premium Base Price (Non EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU_TITLE'      => 'Zone 1 Premium Kilogram Price (EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU_TITLE'   => 'Zone 1 Premium Kilogram Price (Non EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE_TITLE'       => 'Zone 2 Premium Base Price',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG_TITLE'         => 'Zone 2 Premium Kilogram Price',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU_TITLE'    => 'Zone 3 Premium Base Price (EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU_TITLE' => 'Zone 3 Premium Base Price (Non EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU_TITLE'      => 'Zone 3 Premium Kilogram Price (EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU_TITLE'   => 'Zone 3 Premium Kilogram Price (Non EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE_TITLE'       => 'Zone 4 Premium Base Price',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG_TITLE'         => 'Zone 4 Premium Kilogram Price',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE_TITLE'       => 'Zone 5 Premium Base Price',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG_TITLE'         => 'Zone 5 Premium Kilogram Price',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE_TITLE'       => 'Zone 6 Premium Base Price',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG_TITLE'         => 'Zone 6 Premium Kilogram Price',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_END_TITLE'                 => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_END_DESC'                  => '',

    /** Economy */
    'SHIPPING_INTERNATIONAL_ECONOMY_START_TITLE'               => 'Economy Shipping',
    'SHIPPING_INTERNATIONAL_ECONOMY_START_DESC'                => 'Here you will find all the settings related to international economy shipping. Click on the group to open the settings.',

    'SHIPPING_INTERNATIONAL_ECONOMY_ENABLE_TITLE'              => 'Activate Economy Shipping?',
    'SHIPPING_INTERNATIONAL_ECONOMY_ENABLE_DESC'               => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU_TITLE'    => 'Zone 1 Economy Base Price (EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU_TITLE' => 'Zone 1 Economy Base Price (Non EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU_TITLE'      => 'Zone 1 Economy Price per kilogram (EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU_TITLE'   => 'Zone 1 Economy Kilogram Price (Non EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE_TITLE'       => 'Zone 2 Economy Base Price',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG_TITLE'         => 'Zone 2 Economy Kilogram Price',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU_TITLE'    => 'Zone 3 Economy Base Price (EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU_TITLE' => 'Zone 3 Economy Base Price (Non EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU_TITLE'      => 'Zone 3 Economy Price per kilogram (EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU_TITLE'   => 'Zone 3 Economy Kilogram Price (Non EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE_TITLE'       => 'Zone 4 Economy Base Price',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG_TITLE'         => 'Zone 4 Economy Kilogram Price',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE_TITLE'       => 'Zone 5 Economy Base Price',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG_TITLE'         => 'Zone 5 Economy Kilogram Price',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE_TITLE'       => 'Zone 6 Economy Base Price',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG_TITLE'         => 'Zone 6 Economy Kilogram Price',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_END_TITLE'                 => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_END_DESC'                  => '',

    'SHIPPING_INTERNATIONAL_END_TITLE'                         => '',
    'SHIPPING_INTERNATIONAL_END_DESC'                          => '',

    /**
     * Surcharges
     */
    'SURCHARGES_START_TITLE'                                   => 'Impacts',
    'SURCHARGES_START_DESC'                                    => 'Here you will find all the settings regarding the surcharges. Click on the group to open the settings.',

    'SURCHARGES_TITLE'                                         => 'Impacts',
    'SURCHARGES_DESC'                                          => '',

    'SURCHARGES_NAME_TITLE'                                    => 'Name',
    'SURCHARGES_NAME_DESC'                                     => 'Term for the serve.',
    'SURCHARGES_SURCHARGE_TITLE'                               => 'Impact',
    'SURCHARGES_SURCHARGE_DESC'                                => 'How much is the surcharge?',
    'SURCHARGES_TYPE_TITLE'                                    => 'Art',
    'SURCHARGES_TYPE_DESC'                                     => 'What kind of surcharge are we talking about?',
    'SURCHARGES_TYPE_FIXED'                                    => 'Fixed',
    'SURCHARGES_TYPE_PERCENT'                                  => 'Percentage',
    'SURCHARGES_DURATION_START_TITLE'                          => 'From',
    'SURCHARGES_DURATION_START_DESC'                           => 'Optional. From when the surcharge should apply. Year numbers update automatically.',
    'SURCHARGES_DURATION_END_TITLE'                            => 'Until',
    'SURCHARGES_DURATION_END_DESC'                             => 'Optional. Until when the surcharge is to apply. Year numbers update automatically.',

    'SURCHARGES_ROUND_UP_TITLE'                                => 'Round up shipping costs?',
    'SURCHARGES_ROUND_UP_DESC'                                 => 'Allows the shipping costs to be displayed more uniformly by always rounding up the amounts (to e.g. XX.90 €).',
    'SURCHARGES_ROUND_UP_TO_TITLE'                             => 'Round up to',
    'SURCHARGES_ROUND_UP_TO_DESC'                              => 'To which decimal place should always be rounded up?',

    'SURCHARGES_END_TITLE'                                     => '',
    'SURCHARGES_END_DESC'                                      => '',
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
