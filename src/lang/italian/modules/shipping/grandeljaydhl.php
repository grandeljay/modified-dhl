<?php

/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

if (defined('TABLE_COUNTRIES') && defined('MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COUNTRY')) {
    $country = xtc_db_fetch_array(
        xtc_db_query(
            'SELECT *
               FROM `' . TABLE_COUNTRIES . '`
              WHERE `countries_id` = ' . MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COUNTRY
        )
    );
}

$translations_general = array(
    /** Module */
    'TITLE'                           => 'grandeljay - DHL',
    'LONG_DESCRIPTION'                => 'Metodo di spedizione DHL',
    'STATUS_TITLE'                    => 'Attivare il modulo?',
    'STATUS_DESC'                     => 'Consente la spedizione tramite DHL.',

    /** National shipping */
    'SHIPPING_NATIONAL_START_TITLE'   => 'Spedizione nazionale',
    'SHIPPING_NATIONAL_START_DESC'    => 'Qui troverà tutte le impostazioni relative all\'invio nazionale. Clicchi sul gruppo per aprire le impostazioni.',

    'SHIPPING_NATIONAL_COUNTRY_TITLE' => 'Spedizione nazionale',
    'SHIPPING_NATIONAL_COUNTRY_DESC'  => sprintf(
        'La posizione del negozio online è attualmente %s e può essere modificata sotto %s.',
        $country['countries_name'] ?? 'Sconosciuto',
        sprintf(
            '<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s -> %s</a>',
            defined('BOX_HEADING_CONFIGURATION') ? BOX_HEADING_CONFIGURATION : 'BOX_HEADING_CONFIGURATION',
            defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1',
        )
    ),
    'SHIPPING_NATIONAL_COSTS_TITLE'   => 'Costi di spedizione nazionali',
    'SHIPPING_NATIONAL_COSTS_DESC'    => 'Allocazione dei costi di spedizione per pesi diversi.',

    'SHIPPING_NATIONAL_WEIGHT_TITLE'  => 'Peso',
    'SHIPPING_NATIONAL_WEIGHT_DESC'   => 'Peso massimo consentito (in kg) per questo prezzo.',
    'SHIPPING_NATIONAL_COST_TITLE'    => 'Costi',
    'SHIPPING_NATIONAL_COST_DESC'     => 'Spese di spedizione per peso in EUR.',

    'SHIPPING_NATIONAL_BUTTON_ADD'    => 'Aggiungi',
    'SHIPPING_NATIONAL_BUTTON_APPLY'  => 'Prendi il testimone',
    'SHIPPING_NATIONAL_BUTTON_CANCEL' => 'Annullamento',

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
