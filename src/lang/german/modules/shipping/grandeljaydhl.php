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
    'TITLE'            => 'grandeljay - DHL',
    'LONG_DESCRIPTION' => 'DHL Versandart',
    'STATUS_TITLE'     => 'Modul aktivieren?',
    'STATUS_DESC'      => 'Ermöglicht den Versand via DHL.',

    /** Zones */
    'ZONES_TITLE'      => 'Anzahl der Zonen',
    'ZONES_DESC'       => 'Geben Sie an, wie viele verschiedene Versandzonen (Sonderregeln) verfügbar sein sollen. Beim ändern dieses Wertes ist eine Neuinstallation vom Modul erfolderlich. Vergessen Sie nicht ein Backup zu erstellen und anschließend die Einstellungen widerherzustellen.',

    'ALLOWED_TITLE'    => 'Erlaubte Länder',
    'ALLOWED_DESC'     => 'Geben Sie eine Liste an Ländercodes an, in welche der Versand mit DHL generell möglich sein soll (z. B. DE, AT). Leer lassen um alle zu aktivieren.',

    'HANDLING_TITLE'   => 'Bearbeitungsgebühr',
    'HANDLING_DESC'    => 'Basis Bearbeitungsgebühr für diese Versandart, die generell für alle Zonen gilt.',

    'COST_TITLE'       => 'Aufschlag pro KG',
    'COST_DESC'        => 'Der Aufschlag wird für jedes Kilogramm auf die Bearbeitungsgebühr berechnet. Geben Sie den Aufschlag sowie das Maximale Gewicht für den Aufschlag an (z. B. "0.15:10, 0.20:20" für einen Aufschlag von 0,15 bis 10 kg, usw.).',
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
            'ALLOWED_' . $i . '_TITLE'  => sprintf('Zone %d - Erlaubte Länder', $i),
            'ALLOWED_' . $i . '_DESC'   => 'Geben Sie eine Liste an Ländercodes an, um eine Sonderregel für diese Zone zu definieren.',

            /** Handling */
            'HANDLING_' . $i . '_TITLE' => sprintf('Zone %d - Bearbeitungsgebühr', $i),
            'HANDLING_' . $i . '_DESC'  => 'Geben Sie eine Bearbeitungsgeführ für diese Zone an, um die generelle Regel zu überschreiben.',
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
