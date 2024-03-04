<?php

/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

use Grandeljay\Dhl\Configuration\Group;

if (defined('TABLE_COUNTRIES') && defined('MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COUNTRY')) {
    $country_query = xtc_db_query(
        'SELECT *
           FROM `' . TABLE_COUNTRIES . '`
          WHERE `countries_id` = ' . MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COUNTRY
    );
    $country       = xtc_db_fetch_array($country_query);
}

$translations_general = [
    /**
     * Module
     */
    'TITLE'                                                              => 'grandeljay - DHL',
    'LONG_DESCRIPTION'                                                   => 'Metodo di spedizione DHL',
    'STATUS_TITLE'                                                       => 'Attivare il modulo?',
    'STATUS_DESC'                                                        => 'Consente la spedizione tramite DHL.',
    'TEXT_TITLE'                                                         => 'DHL',

    /**
     * Required for modified compatibility
     */
    'ALLOWED_TITLE'                                                      => '',
    'ALLOWED_DESC'                                                       => '',

    /**
     * Debug
     */
    'DEBUG_ENABLE_TITLE'                                                 => 'Modalità Debug',
    'DEBUG_ENABLE_DESC'                                                  => 'Attivare la modalità di debug? Vengono visualizzate ulteriori informazioni, ad esempio come sono stati calcolati i costi di spedizione. È visibile solo agli amministratori.',

    /**
     * Sort Order
     */
    'SORT_ORDER_TITLE'                                                   => 'Ordinamento',
    'SORT_ORDER_DESC'                                                    => 'Determina l\'ordinamento nell\'Admin e nel Checkout. I numeri più bassi vengono visualizzati per primi.',

    /**
     * Weight
     */
    Group::SHIPPING_WEIGHT . '_START_TITLE'                              => 'Peso',
    Group::SHIPPING_WEIGHT . '_START_DESC'                               => 'Qui troverà tutte le impostazioni relative all\'imballaggio e al peso. Clicchi sul gruppo per aprire le impostazioni.',

    Group::SHIPPING_WEIGHT . '_MAX_TITLE'                                => 'Peso massimo',
    Group::SHIPPING_WEIGHT . '_MAX_DESC'                                 => 'Peso massimo che un articolo può avere.',
    Group::SHIPPING_WEIGHT . '_IDEAL_TITLE'                              => 'Peso ideale',
    Group::SHIPPING_WEIGHT . '_IDEAL_DESC'                               => 'Peso target nel calcolo dei costi di spedizione, ad esempio per aumentare la sicurezza del trasporto.',

    Group::SHIPPING_WEIGHT . '_END_TITLE'                                => '',
    Group::SHIPPING_WEIGHT . '_END_DESC'                                 => '',

    /**
     * National
     */
    Group::SHIPPING_NATIONAL . '_START_TITLE'                            => 'Spedizione nazionale',
    Group::SHIPPING_NATIONAL . '_START_DESC'                             => 'Qui troverà tutte le impostazioni relative all\'invio nazionale. Clicchi sul gruppo per aprire le impostazioni.',

    Group::SHIPPING_NATIONAL . '_COUNTRY_TITLE'                          => 'Spedizione nazionale',
    Group::SHIPPING_NATIONAL . '_COUNTRY_DESC'                           => sprintf(
        'La posizione del negozio online è attualmente %s e può essere modificata sotto %s.',
        $country['countries_name'] ?? 'Sconosciuto',
        sprintf(
            '<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s -> %s</a>',
            defined('BOX_HEADING_CONFIGURATION') ? BOX_HEADING_CONFIGURATION : 'BOX_HEADING_CONFIGURATION',
            defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1',
        )
    ),
    Group::SHIPPING_NATIONAL . '_COSTS_TITLE'                            => 'Costi di spedizione nazionali',
    Group::SHIPPING_NATIONAL . '_COSTS_DESC'                             => 'Allocazione dei costi di spedizione per pesi diversi.',

    Group::SHIPPING_NATIONAL . '_WEIGHT_TITLE'                           => 'Peso',
    Group::SHIPPING_NATIONAL . '_WEIGHT_DESC'                            => 'Peso massimo consentito (in kg) per questo prezzo.',
    Group::SHIPPING_NATIONAL . '_COST_TITLE'                             => 'Costi',
    Group::SHIPPING_NATIONAL . '_COST_DESC'                              => 'Spese di spedizione per peso in EUR.',

    Group::SHIPPING_NATIONAL . '_BUTTON_ADD'                             => 'Aggiungi',
    Group::SHIPPING_NATIONAL . '_BUTTON_APPLY'                           => 'Prendi il testimone',
    Group::SHIPPING_NATIONAL . '_BUTTON_CANCEL'                          => 'Annullamento',

    Group::SHIPPING_NATIONAL . '_END_TITLE'                              => '',
    Group::SHIPPING_NATIONAL . '_END_DESC'                               => '',

    /**
     * International
     */
    Group::SHIPPING_INTERNATIONAL . '_START_TITLE'                       => 'Spedizione internazionale',
    Group::SHIPPING_INTERNATIONAL . '_START_DESC'                        => 'Qui troverà tutte le impostazioni relative alla spedizione internazionale. Clicchi sul gruppo per aprire le impostazioni.',

    /** Premium */
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_START_TITLE'               => 'Spedizione premium',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_START_DESC'                => 'Qui troverà tutte le impostazioni relative alla spedizione internazionale permium. Clicchi sul gruppo per aprire le impostazioni.',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_ENABLE_TITLE'              => 'Attivare la spedizione Premium?',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_ENABLE_DESC'               => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_EU_TITLE'    => 'Zona 1 Prezzo base Premium (UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_NONEU_TITLE' => 'Prezzo base Zona 1 Premium (non UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_EU_TITLE'      => 'Zona 1 Prezzo Premium al chilogrammo (UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_NONEU_TITLE'   => 'Zona 1 Prezzo Premium al chilogrammo (non UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_BASE_TITLE'       => 'Prezzo base Zona 2 Premium',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_KG_TITLE'         => 'Zona 2 Prezzo Premium al chilogrammo',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_EU_TITLE'    => 'Prezzo base Zona 3 Premium (UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_NONEU_TITLE' => 'Prezzo base Zona 3 Premium (non UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_EU_TITLE'      => 'Zona 3 Prezzo Premium al chilogrammo (UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_NONEU_TITLE'   => 'Zona 3 Prezzo Premium al chilogrammo (non UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_BASE_TITLE'       => 'Prezzo base Zona 4 Premium',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_KG_TITLE'         => 'Zona 4 Prezzo Premium al chilogrammo',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_BASE_TITLE'       => 'Prezzo base Zona 5 Premium',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_KG_TITLE'         => 'Zona 5 Prezzo Premium al chilogrammo',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_BASE_TITLE'       => 'Prezzo base Zona 6 Premium',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_KG_TITLE'         => 'Zona 6 Prezzo Premium al chilogrammo',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_END_TITLE'                 => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_END_DESC'                  => '',

    /** Economy */
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_START_TITLE'               => 'Spedizione economica',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_START_DESC'                => 'Qui troverà tutte le impostazioni relative alla spedizione economica internazionale. Clicchi sul gruppo per aprire le impostazioni.',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_ENABLE_TITLE'              => 'Attivare la spedizione Economy?',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_ENABLE_DESC'               => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_EU_TITLE'    => 'Zona 1 Economy Prezzo base (UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_NONEU_TITLE' => 'Zona 1 Economy Prezzo base (non UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_EU_TITLE'      => 'Zona 1 Economy Prezzo al chilogrammo (UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_NONEU_TITLE'   => 'Zona 1 Economy Prezzo al chilogrammo (non UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_BASE_TITLE'       => 'Zona 2 Economy Prezzo base',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_KG_TITLE'         => 'Zona 2 Economy Prezzo al chilogrammo',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_EU_TITLE'    => 'Zona 3 Economy Prezzo base (UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_NONEU_TITLE' => 'Zona 3 Economy Prezzo base (non UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_EU_TITLE'      => 'Zona 3 Economy Prezzo per chilogrammo (UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_NONEU_TITLE'   => 'Zona 3 Economy Prezzo al chilogrammo (non UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_BASE_TITLE'       => 'Zona 4 Economy Prezzo base',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_KG_TITLE'         => 'Zona 4 Economy Prezzo al chilogrammo',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_BASE_TITLE'       => 'Zona 5 Economy Prezzo base',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_KG_TITLE'         => 'Zona 5 Economy Prezzo al chilogrammo',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_BASE_TITLE'       => 'Zona 6 Economy Prezzo base',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_KG_TITLE'         => 'Zona 6 Economy Prezzo al chilogrammo',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_END_TITLE'                 => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_END_DESC'                  => '',

    Group::SHIPPING_INTERNATIONAL . '_END_TITLE'                         => '',
    Group::SHIPPING_INTERNATIONAL . '_END_DESC'                          => '',

    /**
     * Surcharges
     */
    Group::SURCHARGES . '_START_TITLE'                                   => 'Impatti',
    Group::SURCHARGES . '_START_DESC'                                    => 'Qui troverà tutte le impostazioni relative ai supplementi. Clicchi sul gruppo per aprire le impostazioni.',

    Group::SURCHARGES . '_TITLE'                                         => 'Impatti',
    Group::SURCHARGES . '_DESC'                                          => '',

    Group::SURCHARGES . '_NAME_TITLE'                                    => 'Nome',
    Group::SURCHARGES . '_NAME_DESC'                                     => 'Termine per il servizio.',
    Group::SURCHARGES . '_SURCHARGE_TITLE'                               => 'Impatto',
    Group::SURCHARGES . '_SURCHARGE_DESC'                                => 'A quanto ammonta il supplemento?',
    Group::SURCHARGES . '_TYPE_TITLE'                                    => 'Arte',
    Group::SURCHARGES . '_TYPE_DESC'                                     => 'Di che tipo di sovrapprezzo stiamo parlando?',
    Group::SURCHARGES . '_TYPE_FIXED'                                    => 'Fisso',
    Group::SURCHARGES . '_TYPE_PERCENT'                                  => 'Percentuale',
    Group::SURCHARGES . '_PER_PACKAGE_TITLE'                             => 'Per confezione',
    Group::SURCHARGES . '_PER_PACKAGE_DESC'                              => 'Il supplemento viene calcolato per ogni pacchetto.',
    Group::SURCHARGES . '_DURATION_START_TITLE'                          => 'Da',
    Group::SURCHARGES . '_DURATION_START_DESC'                           => 'Opzionale. Da quando si applica il supplemento. I numeri dell\'anno si aggiornano automaticamente.',
    Group::SURCHARGES . '_DURATION_END_TITLE'                            => 'Fino a quando',
    Group::SURCHARGES . '_DURATION_END_DESC'                             => 'Opzionale. Fino a quando non verrà applicata la sovrattassa. I numeri dell\'anno si aggiornano automaticamente.',

    Group::SURCHARGES . '_PICK_AND_PACK_TITLE'                           => 'Pick & Pack',
    Group::SURCHARGES . '_PICK_AND_PACK_DESC'                            => 'I costi sostenuti per l\'assemblaggio e l\'imballaggio dell\'ordine.',

    Group::SURCHARGES . '_ROUND_UP_TITLE'                                => 'Arrotondare i costi di spedizione?',
    Group::SURCHARGES . '_ROUND_UP_DESC'                                 => 'Consente di visualizzare le spese di spedizione in modo più uniforme, arrotondando sempre per eccesso gli importi (ad esempio, a XX,90 €).',
    Group::SURCHARGES . '_ROUND_UP_TO_TITLE'                             => 'Arrotondare fino a',
    Group::SURCHARGES . '_ROUND_UP_TO_DESC'                              => 'A quale cifra decimale si deve sempre arrotondare per eccesso?',

    Group::SURCHARGES . '_END_TITLE'                                     => '',
    Group::SURCHARGES . '_END_DESC'                                      => '',
];

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
