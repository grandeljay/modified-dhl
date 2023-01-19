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
    'LONG_DESCRIPTION' => 'DHL Allemagne Mode d\'expédition',
    'STATUS_TITLE'     => 'Activer le module ?',
    'STATUS_DESC'      => 'Permet l\'envoi via DHL.',

    /** Zones */
    'ALLOWED_TITLE'    => 'Pays autorisés',
    'ALLOWED_DESC'     => 'Indiquez une liste de codes de pays vers lesquels l\'envoi doit être possible (par exemple DE, AT). Laissez vide pour les activer tous.',
);

foreach ($translations as $key => $value) {
    $constant = 'MODULE_SHIPPING_' . strtoupper(pathinfo(__FILE__, PATHINFO_FILENAME)) . '_' . $key;

    define($constant, $value);
}
