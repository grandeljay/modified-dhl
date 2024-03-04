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
    $country_name  = $country['countries_name'] ?? 'Unbekannt';
}

$translations_general = [
    /**
     * Module
     */
    'TITLE'                                                              => 'grandeljay - DHL',
    'LONG_DESCRIPTION'                                                   => 'DHL Versandart',
    'STATUS_TITLE'                                                       => 'Modul aktivieren?',
    'STATUS_DESC'                                                        => 'Ermöglicht den Versand via DHL.',
    'TEXT_TITLE'                                                         => 'DHL',

    /**
     * Required for modified compatibility
     */
    'ALLOWED_TITLE'                                                      => '',
    'ALLOWED_DESC'                                                       => '',

    /**
     * Sort Order
     */
    'SORT_ORDER_TITLE'                                                   => 'Sortierreihenfolge',
    'SORT_ORDER_DESC'                                                    => 'Bestimmt die Sortierung im Admin und Checkout. Niedrigste Zahlen werden zuerst angezeigt.',

    /**
     * Debug
     */
    'DEBUG_ENABLE_TITLE'                                                 => 'Debug-Modus',
    'DEBUG_ENABLE_DESC'                                                  => 'Debug-Modus aktivieren? Es werden zusätzliche Informationen angezeigt z. B. wie die Versandkosten errechnet wurden. Nur für Admins sichtbar.',

    /**
     * Weight
     */
    Group::SHIPPING_WEIGHT . '_START_TITLE'                              => 'Gewicht',
    Group::SHIPPING_WEIGHT . '_START_DESC'                               => 'Hier befinden sich alle Einstellungen bezüglich des Verpackens und Gewichts. Klicken Sie auf die Gruppe um die Einstellungen zu öffnen.',

    Group::SHIPPING_WEIGHT . '_MAX_TITLE'                                => 'Maximalgewicht',
    Group::SHIPPING_WEIGHT . '_MAX_DESC'                                 => 'Maximalgewicht in Kilogramm, das ein Artikel haben darf. Wenn ein Artikel im Warenkorb diesen Wert überschreitet, wird die Versandart ausgeblendet.',
    Group::SHIPPING_WEIGHT . '_IDEAL_TITLE'                              => 'Idealgewicht',
    Group::SHIPPING_WEIGHT . '_IDEAL_DESC'                               => 'Zielgewicht beim berechnen der Versandkosten um z. B. die Transportsicherheit zu erhöhen. Pakete werden bis zu diesem Wert gepackt, außer ein Artikel wiegt mehr.',

    Group::SHIPPING_WEIGHT . '_END_TITLE'                                => '',
    Group::SHIPPING_WEIGHT . '_END_DESC'                                 => '',

    /**
     * National
     */
    Group::SHIPPING_NATIONAL . '_START_TITLE'                            => 'Nationaler Versand',
    Group::SHIPPING_NATIONAL . '_START_DESC'                             => 'Hier befinden sich alle Einstellungen bezüglich des nationalen Versands. Klicken Sie auf die Gruppe um die Einstellungen zu öffnen.',

    Group::SHIPPING_NATIONAL . '_COUNTRY_TITLE'                          => 'Nationaler Versand',
    Group::SHIPPING_NATIONAL . '_COUNTRY_DESC'                           => sprintf(
        'Standort des Online Shops ist aktuell %s und kann unter %s angepasst werden.',
        '<em>' . $country_name . '</em>',
        sprintf(
            '<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s -> %s</a>',
            defined('BOX_HEADING_CONFIGURATION') ? BOX_HEADING_CONFIGURATION : 'BOX_HEADING_CONFIGURATION',
            defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1',
        )
    ),
    Group::SHIPPING_NATIONAL . '_COSTS_TITLE'                            => 'Nationale Versand Kosten',
    Group::SHIPPING_NATIONAL . '_COSTS_DESC'                             => 'Zuordnung der Versandkosten für verschiedene Gewichte.',

    Group::SHIPPING_NATIONAL . '_WEIGHT_TITLE'                           => 'Gewicht',
    Group::SHIPPING_NATIONAL . '_WEIGHT_DESC'                            => 'Maximal zulässiges Gewicht (in Kg) für diesen Preis.',
    Group::SHIPPING_NATIONAL . '_COST_TITLE'                             => 'Kosten',
    Group::SHIPPING_NATIONAL . '_COST_DESC'                              => 'Versandkosten für Gewicht in EUR.',

    Group::SHIPPING_NATIONAL . '_BUTTON_ADD'                             => 'Hinzufügen',
    Group::SHIPPING_NATIONAL . '_BUTTON_APPLY'                           => 'Übernehmen',
    Group::SHIPPING_NATIONAL . '_BUTTON_CANCEL'                          => 'Abbrechen',

    Group::SHIPPING_NATIONAL . '_END_TITLE'                              => '',
    Group::SHIPPING_NATIONAL . '_END_DESC'                               => '',

    /**
     * International
     */
    Group::SHIPPING_INTERNATIONAL . '_START_TITLE'                       => 'Internationaler Versand',
    Group::SHIPPING_INTERNATIONAL . '_START_DESC'                        => 'Hier befinden sich alle Einstellungen bezüglich des internationalen Versands. Klicken Sie auf die Gruppe um die Einstellungen zu öffnen.',

    /** Premium */
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_START_TITLE'               => 'Premium Versand',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_START_DESC'                => 'Hier befinden sich alle Einstellungen bezüglich des internationalen permium Versands. Klicken Sie auf die Gruppe um die Einstellungen zu öffnen.',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_ENABLE_TITLE'              => 'Premium Versand aktivieren?',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_ENABLE_DESC'               => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_EU_TITLE'    => 'Zone 1 Premium Basispreis (EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_NONEU_TITLE' => 'Zone 1 Premium Basispreis (Nicht EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_EU_TITLE'      => 'Zone 1 Premium Kilogrammpreis (EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_NONEU_TITLE'   => 'Zone 1 Premium Kilogrammpreis (Nicht EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_BASE_TITLE'       => 'Zone 2 Premium Basispreis',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_KG_TITLE'         => 'Zone 2 Premium Kilogrammpreis',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_EU_TITLE'    => 'Zone 3 Premium Basispreis (EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_NONEU_TITLE' => 'Zone 3 Premium Basispreis (Nicht EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_EU_TITLE'      => 'Zone 3 Premium Kilogrammpreis (EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_NONEU_TITLE'   => 'Zone 3 Premium Kilogrammpreis (Nicht EU)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_BASE_TITLE'       => 'Zone 4 Premium Basispreis',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_KG_TITLE'         => 'Zone 4 Premium Kilogrammpreis',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_BASE_TITLE'       => 'Zone 5 Premium Basispreis',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_KG_TITLE'         => 'Zone 5 Premium Kilogrammpreis',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_BASE_TITLE'       => 'Zone 6 Premium Basispreis',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_KG_TITLE'         => 'Zone 6 Premium Kilogrammpreis',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_END_TITLE'                 => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_END_DESC'                  => '',

    /** Economy */
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_START_TITLE'               => 'Economy Versand',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_START_DESC'                => 'Hier befinden sich alle Einstellungen bezüglich des internationalen economy Versands. Klicken Sie auf die Gruppe um die Einstellungen zu öffnen.',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_ENABLE_TITLE'              => 'Economy Versand aktivieren?',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_ENABLE_DESC'               => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_EU_TITLE'    => 'Zone 1 Economy Basispreis (EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_NONEU_TITLE' => 'Zone 1 Economy Basispreis (Nicht EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_EU_TITLE'      => 'Zone 1 Economy Kilogrammpreis (EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_NONEU_TITLE'   => 'Zone 1 Economy Kilogrammpreis (Nicht EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_BASE_TITLE'       => 'Zone 2 Economy Basispreis',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_KG_TITLE'         => 'Zone 2 Economy Kilogrammpreis',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_EU_TITLE'    => 'Zone 3 Economy Basispreis (EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_NONEU_TITLE' => 'Zone 3 Economy Basispreis (Nicht EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_EU_TITLE'      => 'Zone 3 Economy Kilogrammpreis (EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_NONEU_TITLE'   => 'Zone 3 Economy Kilogrammpreis (Nicht EU)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_BASE_TITLE'       => 'Zone 4 Economy Basispreis',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_KG_TITLE'         => 'Zone 4 Economy Kilogrammpreis',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_BASE_TITLE'       => 'Zone 5 Economy Basispreis',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_KG_TITLE'         => 'Zone 5 Economy Kilogrammpreis',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_BASE_TITLE'       => 'Zone 6 Economy Basispreis',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_KG_TITLE'         => 'Zone 6 Economy Kilogrammpreis',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_END_TITLE'                 => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_END_DESC'                  => '',

    Group::SHIPPING_INTERNATIONAL . '_END_TITLE'                         => '',
    Group::SHIPPING_INTERNATIONAL . '_END_DESC'                          => '',

    /**
     * Surcharges
     */
    Group::SURCHARGES . '_START_TITLE'                                   => 'Aufschläge',
    Group::SURCHARGES . '_START_DESC'                                    => 'Hier befinden sich alle Einstellungen bezüglich der Aufschläge. Klicken Sie auf die Gruppe um die Einstellungen zu öffnen.',

    Group::SURCHARGES . '_TITLE'                                         => 'Aufschläge',
    Group::SURCHARGES . '_DESC'                                          => '',

    Group::SURCHARGES . '_NAME_TITLE'                                    => 'Name',
    Group::SURCHARGES . '_NAME_DESC'                                     => 'Bezeichnung für den Aufschlag.',
    Group::SURCHARGES . '_SURCHARGE_TITLE'                               => 'Aufschlag',
    Group::SURCHARGES . '_SURCHARGE_DESC'                                => 'Wie hoch ist der Aufschlag?',
    Group::SURCHARGES . '_TYPE_TITLE'                                    => 'Art',
    Group::SURCHARGES . '_TYPE_DESC'                                     => 'Um was für einen Aufschlag handelt es sich?',
    Group::SURCHARGES . '_TYPE_FIXED'                                    => 'Fest',
    Group::SURCHARGES . '_TYPE_PERCENT'                                  => 'Prozentual',
    Group::SURCHARGES . '_PER_PACKAGE_TITLE'                             => 'Pro Paket',
    Group::SURCHARGES . '_PER_PACKAGE_DESC'                              => 'Der Aufschlag wird für jedes Paket berechnet.',
    Group::SURCHARGES . '_DURATION_START_TITLE'                          => 'Von',
    Group::SURCHARGES . '_DURATION_START_DESC'                           => 'Optional. Ab wann der Zuschlag gelten soll. Jahreszahlen aktualisieren sich automatisch.',
    Group::SURCHARGES . '_DURATION_END_TITLE'                            => 'Bis',
    Group::SURCHARGES . '_DURATION_END_DESC'                             => 'Optional. Bis wann der Zuschlag gelten soll. Jahreszahlen aktualisieren sich automatisch.',

    Group::SURCHARGES . '_PICK_AND_PACK_TITLE'                           => 'Pick & Pack',
    Group::SURCHARGES . '_PICK_AND_PACK_DESC'                            => 'Kosten die beim zusammenstellen und verpacken der Bestellung entstehen.',

    Group::SURCHARGES . '_ROUND_UP_TITLE'                                => 'Versandkosten aufrunden?',
    Group::SURCHARGES . '_ROUND_UP_DESC'                                 => 'Ermöglicht es die Versandkosten einheitlicher darzustellen, indem die Beträge immer (auf z. B. XX,90 €) aufgerundet werden.',
    Group::SURCHARGES . '_ROUND_UP_TO_TITLE'                             => 'Aufrunden auf',
    Group::SURCHARGES . '_ROUND_UP_TO_DESC'                              => 'Auf welche Nachkommastelle soll immer aufgerundet werden?',

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
