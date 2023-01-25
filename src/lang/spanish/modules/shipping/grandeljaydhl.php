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
    'LONG_DESCRIPTION'                => 'Método de envío DHL',
    'STATUS_TITLE'                    => '¿Activar módulo?',
    'STATUS_DESC'                     => 'Permite el envío a través de DHL.',

    /** National shipping */
    'SHIPPING_NATIONAL_START_TITLE'   => 'Transporte marítimo nacional',
    'SHIPPING_NATIONAL_START_DESC'    => 'Aquí encontrará todos los ajustes relativos al envío nacional. Pulse sobre el grupo para abrir los ajustes.',

    'SHIPPING_NATIONAL_COUNTRY_TITLE' => 'Transporte marítimo nacional',
    'SHIPPING_NATIONAL_COUNTRY_DESC'  => sprintf(
        'La ubicación de la tienda en línea puede ajustarse en Configuración -&gt; %s.',
        sprintf('<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s</a>', defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1')
    ),
    'SHIPPING_NATIONAL_COSTS_TITLE'   => 'Gastos de envío nacionales',
    'SHIPPING_NATIONAL_COSTS_DESC'    => 'Asignación de gastos de envío para distintos pesos.',

    'SHIPPING_NATIONAL_WEIGHT_TITLE'  => 'Peso',
    'SHIPPING_NATIONAL_WEIGHT_DESC'   => 'Peso máximo autorizado (en kg) para este precio.',
    'SHIPPING_NATIONAL_COST_TITLE'    => 'Costes',
    'SHIPPING_NATIONAL_COST_DESC'     => 'Gastos de envío por peso en EUR.',

    'SHIPPING_NATIONAL_BUTTON_ADD'    => 'Añada',
    'SHIPPING_NATIONAL_BUTTON_APPLY'  => 'Asumir',
    'SHIPPING_NATIONAL_BUTTON_CANCEL' => 'Cancelar',

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
