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
    'LONG_DESCRIPTION' => 'DHL Germany Shipping method',
    'STATUS_TITLE'     => 'Activate module?',
    'STATUS_DESC'      => 'Enables shipping via DHL.',

    /** Zones */
    'ALLOWED_TITLE'    => 'Permitted countries',
    'ALLOWED_DESC'     => 'Enter a list of country codes to which shipping should be possible (e.g. DE, AT). Leave blank to activate all.',
);

foreach ($translations as $key => $value) {
    $constant = 'MODULE_SHIPPING_' . strtoupper(pathinfo(__FILE__, PATHINFO_FILENAME)) . '_' . $key;

    define($constant, $value);
}
