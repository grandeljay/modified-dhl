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
    'LONG_DESCRIPTION' => 'Método de envío DHL',
    'STATUS_TITLE'     => '¿Activar módulo?',
    'STATUS_DESC'      => 'Permite el envío a través de DHL.',

    /** Zones */
    'ZONES_TITLE'      => 'Número de zonas',
    'ZONES_DESC'       => 'Especifique cuántas zonas de envío diferentes (reglas especiales) deben estar disponibles. Al cambiar este valor, es necesario reinstalar el módulo. No olvide crear una copia de seguridad y luego restaurar la configuración.',

    'ALLOWED_TITLE'    => 'Países permitidos',
    'ALLOWED_DESC'     => 'Introduzca una lista de códigos de país a los que generalmente debería ser posible realizar envíos con DHL (por ejemplo, DE, AT). Déjelo en blanco para activar todos.',

    'HANDLING_TITLE'   => 'Tasa de tramitación',
    'HANDLING_DESC'    => 'Tasa de manipulación básica para este método de envío, que se aplica generalmente a todas las zonas.',

    'COST_TITLE'       => 'Recargo por KG',
    'COST_DESC'        => 'El recargo se calcula por cada kilogramo sobre la tasa de manipulación. Especifique el recargo, así como el peso máximo del recargo (por ejemplo, "0,15:10, 0,20:20" para un recargo de 0,15 a 10 kg, etc.).',
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
            'ALLOWED_' . $i . '_TITLE'  => sprintf('Zona %d - Países permitidos', $i),
            'ALLOWED_' . $i . '_DESC'   => 'Especifique una lista de códigos de país para definir una regla especial para esta zona.',

            /** Handling */
            'HANDLING_' . $i . '_TITLE' => sprintf('Zona %d - Tasa de manipulación', $i),
            'HANDLING_' . $i . '_DESC'  => 'Especifique una guía de tratamiento para esta zona para anular la regla general.',
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
