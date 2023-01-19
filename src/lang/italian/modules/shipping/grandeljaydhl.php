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
    'LONG_DESCRIPTION' => 'DHL Germania Metodo di spedizione',
    'STATUS_TITLE'     => 'Attivare il modulo?',
    'STATUS_DESC'      => 'Consente la spedizione tramite DHL.',

    /** Zones */
    'ALLOWED_TITLE'    => 'Paesi consentiti',
    'ALLOWED_DESC'     => 'Inserisca un elenco di codici paese verso i quali deve essere possibile la spedizione (ad esempio, DE, AT). Lasciare vuoto per attivare tutti.',
);

foreach ($translations as $key => $value) {
    $constant = 'MODULE_SHIPPING_' . strtoupper(pathinfo(__FILE__, PATHINFO_FILENAME)) . '_' . $key;

    define($constant, $value);
}
