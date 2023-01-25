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
    /** */

    /** Zones */
    'ZONES_TITLE'                     => 'Anzahl der Zonen',
    'ZONES_DESC'                      => 'Geben Sie an, wie viele verschiedene Versandzonen (Sonderregeln) verfügbar sein sollen. Beim ändern dieses Wertes ist eine Neuinstallation vom Modul erfolderlich. Vergessen Sie nicht ein Backup zu erstellen und anschließend die Einstellungen widerherzustellen.',

    'ALLOWED_TITLE'                   => 'Erlaubte Länder',
    'ALLOWED_DESC'                    => 'Geben Sie eine Liste an Ländercodes an, in welche der Versand mit DHL generell möglich sein soll (z. B. DE, AT). Leer lassen um alle zu aktivieren.',

    'HANDLING_TITLE'                  => 'Bearbeitungsgebühr',
    'HANDLING_DESC'                   => 'Basis Bearbeitungsgebühr für diese Versandart, die generell für alle Zonen gilt.',

    'COST_TITLE'                      => 'Aufschlag pro KG',
    'COST_DESC'                       => 'Der Aufschlag wird für jedes Kilogramm auf die Bearbeitungsgebühr berechnet. Geben Sie den Aufschlag sowie das Maximale Gewicht für den Aufschlag an (z. B. "0.15:10, 0.20:20" für einen Aufschlag von 0,15 bis 10 kg, usw.).',
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
