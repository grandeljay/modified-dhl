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
    $country_name  = $country['countries_name'] ?? 'Inconnu';
}

$translations_general = [
    /**
     * Module
     */
    'TITLE'                                                              => 'grandeljay - DHL',
    'LONG_DESCRIPTION'                                                   => 'Mode d\'expédition DHL',
    'STATUS_TITLE'                                                       => 'Activer le module ?',
    'STATUS_DESC'                                                        => 'Permet l\'envoi via DHL.',
    'TEXT_TITLE'                                                         => 'DHL',
    'TEXT_TITLE_DESC'                                                    => 'Livraison par le service postal national.',

    /**
     * Required for modified compatibility
     */
    'ALLOWED_TITLE'                                                      => '',
    'ALLOWED_DESC'                                                       => '',

    /**
     * Sort Order
     */
    'SORT_ORDER_TITLE'                                                   => 'Ordre de tri',
    'SORT_ORDER_DESC'                                                    => 'Détermine le tri dans Admin et Checkout. Les chiffres les plus bas sont affichés en premier.',

    /**
     * Debug
     */
    'DEBUG_ENABLE_TITLE'                                                 => 'Mode de débogage',
    'DEBUG_ENABLE_DESC'                                                  => 'Activer le mode de débogage ? Des informations supplémentaires sont affichées, par exemple comment les frais de port ont été calculés. Visible uniquement par les admins.',

    /**
     * Weight
     */
    Group::SHIPPING_WEIGHT . '_START_TITLE'                              => 'Poids',
    Group::SHIPPING_WEIGHT . '_START_DESC'                               => 'C\'est ici que se trouvent tous les paramètres relatifs à l\'emballage et au poids. Cliquez sur le groupe pour ouvrir les paramètres.',

    Group::SHIPPING_WEIGHT . '_MAX_TITLE'                                => 'Poids maximal',
    Group::SHIPPING_WEIGHT . '_MAX_DESC'                                 => 'Poids maximal qu\'un article peut avoir.',
    Group::SHIPPING_WEIGHT . '_IDEAL_TITLE'                              => 'Poids idéal',
    Group::SHIPPING_WEIGHT . '_IDEAL_DESC'                               => 'Poids cible lors du calcul des frais d\'expédition afin d\'augmenter la sécurité du transport, par exemple.',

    Group::SHIPPING_WEIGHT . '_END_TITLE'                                => '',
    Group::SHIPPING_WEIGHT . '_END_DESC'                                 => '',

    /**
     * National
     */
    Group::SHIPPING_NATIONAL . '_START_TITLE'                            => 'Envoi national',
    Group::SHIPPING_NATIONAL . '_START_DESC'                             => 'C\'est ici que se trouvent tous les paramètres relatifs à l\'envoi national. Cliquez sur le groupe pour ouvrir les paramètres.',

    Group::SHIPPING_NATIONAL . '_COUNTRY_TITLE'                          => 'Envoi national',
    Group::SHIPPING_NATIONAL . '_COUNTRY_DESC'                           => sprintf(
        'L\'emplacement de la boutique en ligne est actuellement %s et peut être modifié sous %s.',
        '<em>' . $country_name . '</em>',
        sprintf(
            '<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s -> %s</a>',
            defined('BOX_HEADING_CONFIGURATION') ? BOX_HEADING_CONFIGURATION : 'BOX_HEADING_CONFIGURATION',
            defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1',
        )
    ),
    Group::SHIPPING_NATIONAL . '_COSTS_TITLE'                            => 'Frais d\'envoi nationaux',
    Group::SHIPPING_NATIONAL . '_COSTS_DESC'                             => 'Affectation des frais de port pour différents poids.',

    Group::SHIPPING_NATIONAL . '_WEIGHT_TITLE'                           => 'Poids',
    Group::SHIPPING_NATIONAL . '_WEIGHT_DESC'                            => 'Poids maximum autorisé (en Kg) pour ce prix.',
    Group::SHIPPING_NATIONAL . '_COST_TITLE'                             => 'Coûts',
    Group::SHIPPING_NATIONAL . '_COST_DESC'                              => 'Frais d\'expédition pour le poids en EUR.',

    Group::SHIPPING_NATIONAL . '_BUTTON_ADD'                             => 'Ajouter',
    Group::SHIPPING_NATIONAL . '_BUTTON_APPLY'                           => 'Reprendre',
    Group::SHIPPING_NATIONAL . '_BUTTON_CANCEL'                          => 'Annuler',

    Group::SHIPPING_NATIONAL . '_END_TITLE'                              => '',
    Group::SHIPPING_NATIONAL . '_END_DESC'                               => '',

    /**
     * International
     */
    Group::SHIPPING_INTERNATIONAL . '_START_TITLE'                       => 'Expédition internationale',
    Group::SHIPPING_INTERNATIONAL . '_START_DESC'                        => 'C\'est ici que se trouvent tous les paramètres relatifs à l\'expédition internationale. Cliquez sur le groupe pour ouvrir les paramètres.',

    /** Premium */
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_START_TITLE'               => 'Expédition premium',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_START_DESC'                => 'C\'est ici que se trouvent tous les paramètres relatifs à l\'envoi international de permium. Cliquez sur le groupe pour ouvrir les paramètres.',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_ENABLE_TITLE'              => 'Activer l\'expédition premium ?',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_ENABLE_DESC'               => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_EU_TITLE'    => 'Zone 1 Premium Prix de base (UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_NONEU_TITLE' => 'Zone 1 Premium Prix de base (hors UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_EU_TITLE'      => 'Zone 1 Premium Prix au kilogramme (UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_NONEU_TITLE'   => 'Zone 1 Premium Prix au kilogramme (hors UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_BASE_TITLE'       => 'Zone 2 Premium Prix de base',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_KG_TITLE'         => 'Zone 2 Premium Prix au kilogramme',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_EU_TITLE'    => 'Zone 3 Premium Prix de base (UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_NONEU_TITLE' => 'Zone 3 Premium Prix de base (hors UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_EU_TITLE'      => 'Zone 3 Premium Prix au kilogramme (UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_NONEU_TITLE'   => 'Zone 3 Premium Prix au kilogramme (hors UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_BASE_TITLE'       => 'Zone 4 Premium Prix de base',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_KG_TITLE'         => 'Zone 4 Premium Prix au kilogramme',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_BASE_TITLE'       => 'Zone 5 Premium Prix de base',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_KG_TITLE'         => 'Zone 5 Premium Prix au kilogramme',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_BASE_TITLE'       => 'Zone 6 Premium Prix de base',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_KG_TITLE'         => 'Zone 6 Premium Prix au kilogramme',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_END_TITLE'                 => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_END_DESC'                  => '',

    /** Economy */
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_START_TITLE'               => 'Expédition économique',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_START_DESC'                => 'C\'est ici que se trouvent tous les paramètres relatifs à l\'envoi économique international. Cliquez sur le groupe pour ouvrir les paramètres.',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_ENABLE_TITLE'              => 'Activer l\'envoi en mode économique ?',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_ENABLE_DESC'               => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_EU_TITLE'    => 'Zone 1 Economy Prix de base (UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_NONEU_TITLE' => 'Zone 1 Economy Prix de base (hors UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_EU_TITLE'      => 'Zone 1 Economy Prix au kilogramme (UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_NONEU_TITLE'   => 'Zone 1 Prix économique au kilogramme (hors UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_BASE_TITLE'       => 'Zone 2 Economy Prix de base',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_KG_TITLE'         => 'Zone 2 Economy Prix au kilogramme',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_EU_TITLE'    => 'Zone 3 Economy Prix de base (UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_NONEU_TITLE' => 'Zone 3 Economy Prix de base (hors UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_EU_TITLE'      => 'Zone 3 Economy Prix au kilogramme (UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_NONEU_TITLE'   => 'Zone 3 Economy Prix au kilogramme (hors UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_BASE_TITLE'       => 'Zone 4 Economy Prix de base',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_KG_TITLE'         => 'Zone 4 Economy Prix au kilogramme',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_BASE_TITLE'       => 'Zone 5 Economy Prix de base',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_KG_TITLE'         => 'Zone 5 Economy Prix au kilogramme',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_BASE_TITLE'       => 'Zone 6 Economy Prix de base',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_KG_TITLE'         => 'Zone 6 Economy Prix au kilogramme',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_END_TITLE'                 => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_END_DESC'                  => '',

    Group::SHIPPING_INTERNATIONAL . '_END_TITLE'                         => '',
    Group::SHIPPING_INTERNATIONAL . '_END_DESC'                          => '',

    /** Exceptions */
    Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_START_TITLE'            => 'Exceptions',
    Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_START_DESC'             => '',

    Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_DATA_TITLE'             => 'Exceptions :',
    Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_DATA_DESC'              => '',

    Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_DATA_COUNTRY_TITLE'     => 'Code du pays',
    Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_DATA_COUNTRY_DESC'      => 'Le code de pays à deux caractères pour cette exception.',
    Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_DATA_COST_TITLE'        => 'Coûts',
    Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_DATA_COST_DESC'         => 'Frais d\'envoi pour le pays indiqué',

    Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_END_TITLE'              => '',
    Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_END_DESC'               => '',

    /**
     * Surcharges
     */
    Group::SURCHARGES . '_START_TITLE'                                   => 'Suppléments',
    Group::SURCHARGES . '_START_DESC'                                    => 'C\'est ici que se trouvent tous les paramètres relatifs aux majorations. Cliquez sur le groupe pour ouvrir les paramètres.',

    Group::SURCHARGES . '_TITLE'                                         => 'Suppléments',
    Group::SURCHARGES . '_DESC'                                          => '',

    Group::SURCHARGES . '_NAME_TITLE'                                    => 'Nom',
    Group::SURCHARGES . '_NAME_DESC'                                     => 'Terme désignant le service.',
    Group::SURCHARGES . '_SURCHARGE_TITLE'                               => 'Service',
    Group::SURCHARGES . '_SURCHARGE_DESC'                                => 'Quel est le montant de la majoration ?',
    Group::SURCHARGES . '_TYPE_TITLE'                                    => 'Art',
    Group::SURCHARGES . '_TYPE_DESC'                                     => 'De quelle majoration s\'agit-il ?',
    Group::SURCHARGES . '_TYPE_FIXED'                                    => 'Fixe',
    Group::SURCHARGES . '_TYPE_PERCENT'                                  => 'Pourcentage',
    Group::SURCHARGES . '_PER_PACKAGE_TITLE'                             => 'Par paquet',
    Group::SURCHARGES . '_PER_PACKAGE_DESC'                              => 'Le supplément est calculé pour chaque paquet.',
    Group::SURCHARGES . '_DURATION_START_TITLE'                          => 'De',
    Group::SURCHARGES . '_DURATION_START_DESC'                           => 'En option, vous pouvez choisir. Date à partir de laquelle le supplément doit s\'appliquer. Les années sont automatiquement mises à jour.',
    Group::SURCHARGES . '_DURATION_END_TITLE'                            => 'Jusqu\'à',
    Group::SURCHARGES . '_DURATION_END_DESC'                             => 'En option, vous pouvez choisir. Jusqu\'à quelle date le supplément doit s\'appliquer. Les années sont automatiquement mises à jour.',

    Group::SURCHARGES . '_PICK_AND_PACK_TITLE'                           => 'Pick & Pack',
    Group::SURCHARGES . '_PICK_AND_PACK_DESC'                            => 'Frais encourus pour la préparation et l\'emballage de la commande.',

    Group::SURCHARGES . '_ROUND_UP_TITLE'                                => 'Arrondir les frais de port ?',
    Group::SURCHARGES . '_ROUND_UP_DESC'                                 => 'Permet de présenter les frais d\'expédition de manière plus cohérente en arrondissant toujours les montants (à XX,90 € par exemple) vers le haut.',
    Group::SURCHARGES . '_ROUND_UP_TO_TITLE'                             => 'Arrondir à l\'unité supérieure',
    Group::SURCHARGES . '_ROUND_UP_TO_DESC'                              => 'A quelle décimale doit-on toujours arrondir ?',

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
