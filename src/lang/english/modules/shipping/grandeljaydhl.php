<?php

/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

$translations_general = array(
    /** Module */
    'TITLE'                           => 'grandeljay - DHL',
    'LONG_DESCRIPTION'                => 'DHL shipping method',
    'STATUS_TITLE'                    => 'Activate module?',
    'STATUS_DESC'                     => 'Enables shipping via DHL.',

    /** National shipping */
    'SHIPPING_NATIONAL_COUNTRY_TITLE' => 'National Shipping',
    'SHIPPING_NATIONAL_COUNTRY_DESC'  => sprintf(
        'The location of the online shop can be adjusted under Configuration -&gt; %s.',
        sprintf('<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s</a>', defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1')
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
    /** */

    /** Zones */
    'ZONES_TITLE'                     => 'Number of zones',
    'ZONES_DESC'                      => 'Specify how many different shipping zones (special rules) should be available. When changing this value, it is necessary to reinstall the module. Do not forget to create a backup and then restore the settings.',

    'ALLOWED_TITLE'                   => 'Permitted countries',
    'ALLOWED_DESC'                    => 'Enter a list of country codes to which shipping with DHL should generally be possible (e.g. DE, AT). Leave blank to activate all.',

    'HANDLING_TITLE'                  => 'Handling fee',
    'HANDLING_DESC'                   => 'Basic handling fee for this shipping method, which generally applies to all zones.',

    'COST_TITLE'                      => 'Surcharge per KG',
    'COST_DESC'                       => 'The surcharge is calculated for each kilogram on the handling fee. Specify the mark-up as well as the Maximum Weight for the mark-up (e.g. "0.15:10, 0.20:20" for a mark-up of 0.15 to 10 kg, etc.).',
);

/**
 * Zones
 */
require_once DIR_FS_DOCUMENT_ROOT . 'includes/modules/shipping/grandeljaydhl.php';

$grandeljaydhl = new grandeljaydhl();

$translations_zones = array();

for ($i = 1; $i <= $grandeljaydhl->getZonesCount(); $i++) {
    $translations_zones = array_merge(
        $translations_zones,
        array(
            /** Zones */
            'ALLOWED_' . $i . '_TITLE'  => sprintf('Zone %d - Permitted countries', $i),
            'ALLOWED_' . $i . '_DESC'   => 'Specify a list of country codes to define a special rule for this zone.',

            /** Handling */
            'HANDLING_' . $i . '_TITLE' => sprintf('Zone %d - Handling fee', $i),
            'HANDLING_' . $i . '_DESC'  => 'Specify a processing guide for this zone to override the general rule.',
        ),
    );
}

/**
 * Define
 */
$translations = array_merge(
    $translations_general,
    $translations_zones,
);

foreach ($translations as $key => $value) {
    $constant = 'MODULE_SHIPPING_' . strtoupper(pathinfo(__FILE__, PATHINFO_FILENAME)) . '_' . $key;

    define($constant, $value);
}
