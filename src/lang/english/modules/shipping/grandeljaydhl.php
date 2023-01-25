<?php

/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

if (defined('TABLE_COUNTRIES') && defined('MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COUNTRY')) {
    $country = xtc_db_fetch_array(
        xtc_db_query(
            'SELECT *
               FROM `' . TABLE_COUNTRIES . '`
              WHERE `countries_id` = ' . MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COUNTRY
        )
    );
}

$translations_general = array(
    /** Module */
    'TITLE'                           => 'grandeljay - DHL',
    'LONG_DESCRIPTION'                => 'DHL shipping method',
    'STATUS_TITLE'                    => 'Activate module?',
    'STATUS_DESC'                     => 'Enables shipping via DHL.',

    /** National shipping */
    'SHIPPING_NATIONAL_START_TITLE'   => 'National shipping',
    'SHIPPING_NATIONAL_START_DESC'    => 'Here you will find all the settings relating to national dispatch. Click on the group to open the settings.',

    'SHIPPING_NATIONAL_COUNTRY_TITLE' => 'National Shipping',
    'SHIPPING_NATIONAL_COUNTRY_DESC'  => sprintf(
        'Location of the online shop is currently %s and can be adjusted under %s.',
        $country['countries_name'] ?? 'Unknown',
        sprintf(
            '<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s -> %s</a>',
            defined('BOX_HEADING_CONFIGURATION') ? BOX_HEADING_CONFIGURATION : 'BOX_HEADING_CONFIGURATION',
            defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1',
        )
    ),
    'SHIPPING_NATIONAL_COSTS_TITLE'   => 'National shipping costs',
    'SHIPPING_NATIONAL_COSTS_DESC'    => 'Allocation of shipping costs for different weights.',

    'SHIPPING_NATIONAL_WEIGHT_TITLE'  => 'Weight',
    'SHIPPING_NATIONAL_WEIGHT_DESC'   => 'Maximum permissible weight (in kg) for this price.',
    'SHIPPING_NATIONAL_COST_TITLE'    => 'Cost',
    'SHIPPING_NATIONAL_COST_DESC'     => 'Shipping costs for weight in EUR.',

    'SHIPPING_NATIONAL_BUTTON_ADD'    => 'Add',
    'SHIPPING_NATIONAL_BUTTON_APPLY'  => 'Apply',
    'SHIPPING_NATIONAL_BUTTON_CANCEL' => 'Cancel',

    'SHIPPING_NATIONAL_END_TITLE'     => '',
    'SHIPPING_NATIONAL_END_DESC'      => '',
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
