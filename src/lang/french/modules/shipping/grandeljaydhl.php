<?php

/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

$translations_general = array(
    /** Module */
    'TITLE'                           => 'grandeljay - DHL',
    'LONG_DESCRIPTION'                => 'Mode d\'expédition DHL',
    'STATUS_TITLE'                    => 'Activer le module ?',
    'STATUS_DESC'                     => 'Permet l\'envoi via DHL.',

    /** National shipping */
    'SHIPPING_NATIONAL_COUNTRY_TITLE' => 'Envoi national',
    'SHIPPING_NATIONAL_COUNTRY_DESC'  => sprintf(
        'L\'emplacement de la boutique en ligne peut être ajusté dans Configuration -&gt; %s.',
        sprintf('<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s</a>', defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1')
    ),
    'SHIPPING_NATIONAL_COSTS_TITLE'   => 'Frais d\'envoi nationaux',
    'SHIPPING_NATIONAL_COSTS_DESC'    => 'Affectation des frais de port pour différents poids.',

    'SHIPPING_NATIONAL_WEIGHT_TITLE'  => 'Poids',
    'SHIPPING_NATIONAL_WEIGHT_DESC'   => 'Poids maximum autorisé (en Kg) pour ce prix.',
    'SHIPPING_NATIONAL_COST_TITLE'    => 'Coûts',
    'SHIPPING_NATIONAL_COST_DESC'     => 'Frais d\'expédition pour le poids en EUR.',

    'SHIPPING_NATIONAL_BUTTON_ADD'    => 'Ajouter',
    'SHIPPING_NATIONAL_BUTTON_APPLY'  => 'Reprendre',
    'SHIPPING_NATIONAL_BUTTON_CANCEL' => 'Annuler',
    /** */

    /** Zones */
    'ZONES_TITLE'                     => 'Nombre de zones',
    'ZONES_DESC'                      => 'Indiquez le nombre de zones d\'expédition différentes (règles spéciales) qui doivent être disponibles. Si vous modifiez cette valeur, vous devez réinstaller le module. N\'oubliez pas de faire une sauvegarde et de restaurer les paramètres.',

    'ALLOWED_TITLE'                   => 'Pays autorisés',
    'ALLOWED_DESC'                    => 'Indiquez une liste de codes de pays vers lesquels l\'expédition par DHL doit être généralement possible (par exemple DE, AT). Laissez vide pour les activer tous.',

    'HANDLING_TITLE'                  => 'Frais de dossier',
    'HANDLING_DESC'                   => 'Frais de traitement de base pour ce type d\'envoi, qui s\'applique généralement à toutes les zones.',

    'COST_TITLE'                      => 'Supplément par KG',
    'COST_DESC'                       => 'La majoration est calculée pour chaque kilogramme sur les frais de traitement. Indiquez la majoration ainsi que le poids maximum pour la majoration (par exemple "0.15:10, 0.20:20" pour une majoration de 0,15 à 10 kg, etc.)',
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
