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
    /**
     * Module
     */
    'TITLE'                                                    => 'grandeljay - DHL',
    'LONG_DESCRIPTION'                                         => 'Mode d\'expédition DHL',
    'STATUS_TITLE'                                             => 'Activer le module ?',
    'STATUS_DESC'                                              => 'Permet l\'envoi via DHL.',

    /**
     * National
     */
    'SHIPPING_NATIONAL_START_TITLE'                            => 'Envoi national',
    'SHIPPING_NATIONAL_START_DESC'                             => 'C\'est ici que se trouvent tous les paramètres relatifs à l\'envoi national. Cliquez sur le groupe pour ouvrir les paramètres.',

    'SHIPPING_NATIONAL_COUNTRY_TITLE'                          => 'Envoi national',
    'SHIPPING_NATIONAL_COUNTRY_DESC'                           => sprintf(
        'L\'emplacement de la boutique en ligne est actuellement %s et peut être modifié sous %s.',
        $country['countries_name'] ?? 'Inconnu',
        sprintf(
            '<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s -> %s</a>',
            defined('BOX_HEADING_CONFIGURATION') ? BOX_HEADING_CONFIGURATION : 'BOX_HEADING_CONFIGURATION',
            defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1',
        )
    ),
    'SHIPPING_NATIONAL_COSTS_TITLE'                            => 'Frais d\'envoi nationaux',
    'SHIPPING_NATIONAL_COSTS_DESC'                             => 'Affectation des frais de port pour différents poids.',

    'SHIPPING_NATIONAL_WEIGHT_TITLE'                           => 'Poids',
    'SHIPPING_NATIONAL_WEIGHT_DESC'                            => 'Poids maximum autorisé (en Kg) pour ce prix.',
    'SHIPPING_NATIONAL_COST_TITLE'                             => 'Coûts',
    'SHIPPING_NATIONAL_COST_DESC'                              => 'Frais d\'expédition pour le poids en EUR.',

    'SHIPPING_NATIONAL_BUTTON_ADD'                             => 'Ajouter',
    'SHIPPING_NATIONAL_BUTTON_APPLY'                           => 'Reprendre',
    'SHIPPING_NATIONAL_BUTTON_CANCEL'                          => 'Annuler',

    'SHIPPING_NATIONAL_END_TITLE'                              => '',
    'SHIPPING_NATIONAL_END_DESC'                               => '',

    /**
     * International
     */
    'SHIPPING_INTERNATIONAL_START_TITLE'                       => 'Internationaler Versand',
    'SHIPPING_INTERNATIONAL_START_DESC'                        => 'Hier befinden sich alle Einstellungen bezüglich des internationalen Versands. Klicken Sie auf die Gruppe um die Einstellungen zu öffnen.',

    /** Premium */
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU_TITLE'    => 'Zone 1 Premium Prix de base (UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU_TITLE' => 'Zone 1 Premium Prix de base (hors UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU_TITLE'      => 'Zone 1 Premium Prix au kilogramme (UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU_TITLE'   => 'Zone 1 Premium Prix au kilogramme (hors UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE_TITLE'       => 'Zone 2 Premium Prix de base',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG_TITLE'         => 'Zone 2 Premium Prix au kilogramme',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU_TITLE'    => 'Zone 3 Premium Prix de base (UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU_TITLE' => 'Zone 3 Premium Prix de base (hors UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU_TITLE'      => 'Zone 3 Premium Prix au kilogramme (UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU_TITLE'   => 'Zone 3 Premium Prix au kilogramme (hors UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE_TITLE'       => 'Zone 4 Premium Prix de base',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG_TITLE'         => 'Zone 4 Premium Prix au kilogramme',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE_TITLE'       => 'Zone 5 Premium Prix de base',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG_TITLE'         => 'Zone 5 Premium Prix au kilogramme',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE_TITLE'       => 'Zone 6 Premium Prix de base',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG_TITLE'         => 'Zone 6 Premium Prix au kilogramme',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG_DESC'          => '',

    /** Economy */
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU_TITLE'    => 'Zone 1 Economy Prix de base (UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU_TITLE' => 'Zone 1 Economy Prix de base (hors UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU_TITLE'      => 'Zone 1 Economy Prix au kilogramme (UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU_TITLE'   => 'Zone 1 Prix économique au kilogramme (hors UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE_TITLE'       => 'Zone 2 Economy Prix de base',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG_TITLE'         => 'Zone 2 Economy Prix au kilogramme',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU_TITLE'    => 'Zone 3 Economy Prix de base (UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU_TITLE' => 'Zone 3 Economy Prix de base (hors UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU_TITLE'      => 'Zone 3 Economy Prix au kilogramme (UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU_TITLE'   => 'Zone 3 Economy Prix au kilogramme (hors UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE_TITLE'       => 'Zone 4 Economy Prix de base',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG_TITLE'         => 'Zone 4 Economy Prix au kilogramme',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE_TITLE'       => 'Zone 5 Economy Prix de base',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG_TITLE'         => 'Zone 5 Economy Prix au kilogramme',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE_TITLE'       => 'Zone 6 Economy Prix de base',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG_TITLE'         => 'Zone 6 Economy Prix au kilogramme',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_END_TITLE'                         => '',
    'SHIPPING_INTERNATIONAL_END_DESC'                          => '',
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
