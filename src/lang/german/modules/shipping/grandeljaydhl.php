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
    'LONG_DESCRIPTION'                => 'DHL Versandart',
    'STATUS_TITLE'                    => 'Modul aktivieren?',
    'STATUS_DESC'                     => 'Ermöglicht den Versand via DHL.',

    /** National shipping */
    'SHIPPING_NATIONAL_START_TITLE'   => 'Nationaler Versand',
    'SHIPPING_NATIONAL_START_DESC'    => 'Hier befinden sich alle Einstellungen bezüglich des nationalen Versands. Klicken Sie auf die Gruppe um die Einstellungen zu öffnen.',

    'SHIPPING_NATIONAL_COUNTRY_TITLE' => 'Nationaler Versand',
    'SHIPPING_NATIONAL_COUNTRY_DESC'  => sprintf(
        'Standort des Online Shops kann unter Konfiguration -> %s angepasst werden.',
        sprintf('<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s</a>', defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1')
    ),
    'SHIPPING_NATIONAL_COSTS_TITLE'   => 'Nationale Versand Kosten',
    'SHIPPING_NATIONAL_COSTS_DESC'    => 'Zuordnung der Versandkosten für verschiedene Gewichte.',

    'SHIPPING_NATIONAL_WEIGHT_TITLE'  => 'Gewicht',
    'SHIPPING_NATIONAL_WEIGHT_DESC'   => 'Maximal zulässiges Gewicht (in Kg) für diesen Preis.',
    'SHIPPING_NATIONAL_COST_TITLE'    => 'Kosten',
    'SHIPPING_NATIONAL_COST_DESC'     => 'Versandkosten für Gewicht in EUR.',

    'SHIPPING_NATIONAL_BUTTON_ADD'    => 'Hinzufügen',
    'SHIPPING_NATIONAL_BUTTON_APPLY'  => 'Übernehmen',
    'SHIPPING_NATIONAL_BUTTON_CANCEL' => 'Abbrechen',

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
