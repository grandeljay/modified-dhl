<?php

/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

$translations = array(
    /** Module */
    'TITLE'            => 'grandeljay - DHL',
    'LONG_DESCRIPTION' => 'DHL Alemania Forma de envío',
    'STATUS_TITLE'     => '¿Activar módulo?',
    'STATUS_DESC'      => 'Permite el envío a través de DHL.',

    /** Zones */
    'ALLOWED_TITLE'    => 'Países permitidos',
    'ALLOWED_DESC'     => 'Introduzca una lista de códigos de país a los que debería ser posible realizar el envío (por ejemplo, DE, AT). Déjelo en blanco para activar todos.',
);

foreach ($translations as $key => $value) {
    $constant = 'MODULE_SHIPPING_' . strtoupper(pathinfo(__FILE__, PATHINFO_FILENAME)) . '_' . $key;

    define($constant, $value);
}
