<?php

/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

if (defined('TABLE_COUNTRIES') && defined('MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COUNTRY')) {
    $country_query = xtc_db_query(
        'SELECT *
           FROM `' . TABLE_COUNTRIES . '`
          WHERE `countries_id` = ' . MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COUNTRY
    );
    $country       = xtc_db_fetch_array($country_query);
}
$translations_general = array(
    /**
     * Module
     */
    'TITLE'                                                    => 'grandeljay - DHL',
    'LONG_DESCRIPTION'                                         => 'Metodo di spedizione DHL',
    'STATUS_TITLE'                                             => 'Attivare il modulo?',
    'STATUS_DESC'                                              => 'Consente la spedizione tramite DHL.',

    /**
     * Required for modified compatibility
     */
    'ALLOWED_TITLE'                                            => '',
    'ALLOWED_DESC'                                             => '',
    /** */

    /**
     * National
     */
    'SHIPPING_NATIONAL_START_TITLE'                            => 'Spedizione nazionale',
    'SHIPPING_NATIONAL_START_DESC'                             => 'Qui troverà tutte le impostazioni relative all\'invio nazionale. Clicchi sul gruppo per aprire le impostazioni.',

    'SHIPPING_NATIONAL_COUNTRY_TITLE'                          => 'Spedizione nazionale',
    'SHIPPING_NATIONAL_COUNTRY_DESC'                           => sprintf(
        'La posizione del negozio online è attualmente %s e può essere modificata sotto %s.',
        $country['countries_name'] ?? 'Sconosciuto',
        sprintf(
            '<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s -> %s</a>',
            defined('BOX_HEADING_CONFIGURATION') ? BOX_HEADING_CONFIGURATION : 'BOX_HEADING_CONFIGURATION',
            defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1',
        )
    ),
    'SHIPPING_NATIONAL_COSTS_TITLE'                            => 'Costi di spedizione nazionali',
    'SHIPPING_NATIONAL_COSTS_DESC'                             => 'Allocazione dei costi di spedizione per pesi diversi.',

    'SHIPPING_NATIONAL_WEIGHT_TITLE'                           => 'Peso',
    'SHIPPING_NATIONAL_WEIGHT_DESC'                            => 'Peso massimo consentito (in kg) per questo prezzo.',
    'SHIPPING_NATIONAL_COST_TITLE'                             => 'Costi',
    'SHIPPING_NATIONAL_COST_DESC'                              => 'Spese di spedizione per peso in EUR.',

    'SHIPPING_NATIONAL_BUTTON_ADD'                             => 'Aggiungi',
    'SHIPPING_NATIONAL_BUTTON_APPLY'                           => 'Prendi il testimone',
    'SHIPPING_NATIONAL_BUTTON_CANCEL'                          => 'Annullamento',

    'SHIPPING_NATIONAL_END_TITLE'                              => '',
    'SHIPPING_NATIONAL_END_DESC'                               => '',

    /**
     * International
     */
    'SHIPPING_INTERNATIONAL_START_TITLE'                       => 'Internationaler Versand',
    'SHIPPING_INTERNATIONAL_START_DESC'                        => 'Hier befinden sich alle Einstellungen bezüglich des internationalen Versands. Klicken Sie auf die Gruppe um die Einstellungen zu öffnen.',

    /** Premium */
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU_TITLE'    => 'Zona 1 Prezzo base Premium (UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU_TITLE' => 'Prezzo base Zona 1 Premium (non UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU_TITLE'      => 'Zona 1 Prezzo Premium al chilogrammo (UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU_TITLE'   => 'Zona 1 Prezzo Premium al chilogrammo (non UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE_TITLE'       => 'Prezzo base Zona 2 Premium',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG_TITLE'         => 'Zona 2 Prezzo Premium al chilogrammo',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU_TITLE'    => 'Prezzo base Zona 3 Premium (UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU_TITLE' => 'Prezzo base Zona 3 Premium (non UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU_TITLE'      => 'Zona 3 Prezzo Premium al chilogrammo (UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU_TITLE'   => 'Zona 3 Prezzo Premium al chilogrammo (non UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE_TITLE'       => 'Prezzo base Zona 4 Premium',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG_TITLE'         => 'Zona 4 Prezzo Premium al chilogrammo',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE_TITLE'       => 'Prezzo base Zona 5 Premium',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG_TITLE'         => 'Zona 5 Prezzo Premium al chilogrammo',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE_TITLE'       => 'Prezzo base Zona 6 Premium',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG_TITLE'         => 'Zona 6 Prezzo Premium al chilogrammo',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG_DESC'          => '',

    /** Economy */
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU_TITLE'    => 'Zona 1 Economy Prezzo base (UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU_TITLE' => 'Zona 1 Economy Prezzo base (non UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU_TITLE'      => 'Zona 1 Economy Prezzo al chilogrammo (UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU_TITLE'   => 'Zona 1 Economy Prezzo al chilogrammo (non UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE_TITLE'       => 'Zona 2 Economy Prezzo base',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG_TITLE'         => 'Zona 2 Economy Prezzo al chilogrammo',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU_TITLE'    => 'Zona 3 Economy Prezzo base (UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU_TITLE' => 'Zona 3 Economy Prezzo base (non UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU_TITLE'      => 'Zona 3 Economy Prezzo per chilogrammo (UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU_TITLE'   => 'Zona 3 Economy Prezzo al chilogrammo (non UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE_TITLE'       => 'Zona 4 Economy Prezzo base',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG_TITLE'         => 'Zona 4 Economy Prezzo al chilogrammo',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE_TITLE'       => 'Zona 5 Economy Prezzo base',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG_TITLE'         => 'Zona 5 Economy Prezzo al chilogrammo',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE_TITLE'       => 'Zona 6 Economy Prezzo base',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG_TITLE'         => 'Zona 6 Economy Prezzo al chilogrammo',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_END_TITLE'                         => '',
    'SHIPPING_INTERNATIONAL_END_DESC'                          => '',

    /**
     * Surcharges
     */
    'SURCHARGES_START_TITLE'                                   => 'Impatti',
    'SURCHARGES_START_DESC'                                    => 'Qui troverà tutte le impostazioni relative ai supplementi. Clicchi sul gruppo per aprire le impostazioni.',

    'SURCHARGES_TITLE'                                         => 'Impatti',
    'SURCHARGES_DESC'                                          => '',

    'SURCHARGES_NAME_TITLE'                                    => 'Nome',
    'SURCHARGES_NAME_DESC'                                     => 'Termine per il servizio.',
    'SURCHARGES_SURCHARGE_TITLE'                               => 'Impatto',
    'SURCHARGES_SURCHARGE_DESC'                                => 'A quanto ammonta il supplemento?',
    'SURCHARGES_TYPE_TITLE'                                    => 'Arte',
    'SURCHARGES_TYPE_DESC'                                     => 'Di che tipo di sovrapprezzo stiamo parlando?',
    'SURCHARGES_TYPE_FIXED'                                    => 'Fisso',
    'SURCHARGES_TYPE_PERCENT'                                  => 'Percentuale',
    'SURCHARGES_DURATION_START_TITLE'                          => 'Da',
    'SURCHARGES_DURATION_START_DESC'                           => 'Opzionale. Da quando si applica il supplemento (GG.MM.)',
    'SURCHARGES_DURATION_END_TITLE'                            => 'Fino a quando',
    'SURCHARGES_DURATION_END_DESC'                             => 'Opzionale. Fino alla data di applicazione del supplemento (GG.MM.)',

    'SURCHARGES_ROUND_UP_TITLE'                                => 'Arrotondare i costi di spedizione?',
    'SURCHARGES_ROUND_UP_DESC'                                 => 'Consente di visualizzare le spese di spedizione in modo più uniforme, arrotondando sempre per eccesso gli importi (ad esempio, a XX,90 €).',
    'SURCHARGES_ROUND_UP_TO_TITLE'                             => 'Arrotondare fino a',
    'SURCHARGES_ROUND_UP_TO_DESC'                              => 'A quale cifra decimale si deve sempre arrotondare per eccesso?',

    'SURCHARGES_END_TITLE'                                     => '',
    'SURCHARGES_END_DESC'                                      => '',
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
