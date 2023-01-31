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
    'LONG_DESCRIPTION'                                         => 'Mode d\'expédition DHL',
    'STATUS_TITLE'                                             => 'Activer le module ?',
    'STATUS_DESC'                                              => 'Permet l\'envoi via DHL.',
    'TEXT_TITLE'                                               => 'DHL',

    /**
     * Required for modified compatibility
     */
    'ALLOWED_TITLE'                                            => '',
    'ALLOWED_DESC'                                             => '',
    /** */

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
    'SHIPPING_INTERNATIONAL_START_TITLE'                       => 'Expédition internationale',
    'SHIPPING_INTERNATIONAL_START_DESC'                        => 'C\'est ici que se trouvent tous les paramètres relatifs à l\'expédition internationale. Cliquez sur le groupe pour ouvrir les paramètres.',

    /** Premium */
    'SHIPPING_INTERNATIONAL_PREMIUM_START_TITLE'               => 'Expédition premium',
    'SHIPPING_INTERNATIONAL_PREMIUM_START_DESC'                => 'C\'est ici que se trouvent tous les paramètres relatifs à l\'envoi international de permium. Cliquez sur le groupe pour ouvrir les paramètres.',

    'SHIPPING_INTERNATIONAL_PREMIUM_ENABLE_TITLE'              => 'Activer l\'expédition premium ?',
    'SHIPPING_INTERNATIONAL_PREMIUM_ENABLE_DESC'               => '',

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

    'SHIPPING_INTERNATIONAL_PREMIUM_END_TITLE'                 => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_END_DESC'                  => '',

    /** Economy */
    'SHIPPING_INTERNATIONAL_ECONOMY_START_TITLE'               => 'Expédition économique',
    'SHIPPING_INTERNATIONAL_ECONOMY_START_DESC'                => 'C\'est ici que se trouvent tous les paramètres relatifs à l\'envoi économique international. Cliquez sur le groupe pour ouvrir les paramètres.',

    'SHIPPING_INTERNATIONAL_ECONOMY_ENABLE_TITLE'              => 'Activer l\'envoi en mode économique ?',
    'SHIPPING_INTERNATIONAL_ECONOMY_ENABLE_DESC'               => '',

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

    'SHIPPING_INTERNATIONAL_ECONOMY_END_TITLE'                 => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_END_DESC'                  => '',

    'SHIPPING_INTERNATIONAL_END_TITLE'                         => '',
    'SHIPPING_INTERNATIONAL_END_DESC'                          => '',

    /**
     * Surcharges
     */
    'SURCHARGES_START_TITLE'                                   => 'Suppléments',
    'SURCHARGES_START_DESC'                                    => 'C\'est ici que se trouvent tous les paramètres relatifs aux majorations. Cliquez sur le groupe pour ouvrir les paramètres.',

    'SURCHARGES_TITLE'                                         => 'Suppléments',
    'SURCHARGES_DESC'                                          => '',

    'SURCHARGES_NAME_TITLE'                                    => 'Nom',
    'SURCHARGES_NAME_DESC'                                     => 'Terme désignant le service.',
    'SURCHARGES_SURCHARGE_TITLE'                               => 'Service',
    'SURCHARGES_SURCHARGE_DESC'                                => 'Quel est le montant de la majoration ?',
    'SURCHARGES_TYPE_TITLE'                                    => 'Art',
    'SURCHARGES_TYPE_DESC'                                     => 'De quelle majoration s\'agit-il ?',
    'SURCHARGES_TYPE_FIXED'                                    => 'Fixe',
    'SURCHARGES_TYPE_PERCENT'                                  => 'Pourcentage',
    'SURCHARGES_DURATION_START_TITLE'                          => 'De',
    'SURCHARGES_DURATION_START_DESC'                           => 'En option, vous pouvez choisir. Date à partir de laquelle le supplément doit s\'appliquer. Les années sont automatiquement mises à jour.',
    'SURCHARGES_DURATION_END_TITLE'                            => 'Jusqu\'à',
    'SURCHARGES_DURATION_END_DESC'                             => 'En option, vous pouvez choisir. Jusqu\'à quelle date le supplément doit s\'appliquer. Les années sont automatiquement mises à jour.',

    'SURCHARGES_ROUND_UP_TITLE'                                => 'Arrondir les frais de port ?',
    'SURCHARGES_ROUND_UP_DESC'                                 => 'Permet de présenter les frais d\'expédition de manière plus cohérente en arrondissant toujours les montants (à XX,90 € par exemple) vers le haut.',
    'SURCHARGES_ROUND_UP_TO_TITLE'                             => 'Arrondir à l\'unité supérieure',
    'SURCHARGES_ROUND_UP_TO_DESC'                              => 'A quelle décimale doit-on toujours arrondir ?',

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
