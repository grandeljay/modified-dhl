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
    'LONG_DESCRIPTION'                                         => 'DHL Versandart',
    'STATUS_TITLE'                                             => 'Modul aktivieren?',
    'STATUS_DESC'                                              => 'Ermöglicht den Versand via DHL.',
    'TEXT_TITLE'                                               => 'DHL',

    /**
     * Required for modified compatibility
     */
    'ALLOWED_TITLE'                                            => '',
    'ALLOWED_DESC'                                             => '',
    /** */

    /**
     * Debug
     */
    'DEBUG_ENABLE_TITLE'                                       => 'Debug-Modus',
    'DEBUG_ENABLE_DESC'                                        => 'Debug-Modus aktivieren? Es werden zusätzliche Informationen angezeigt z. B. wie die Versandkosten errechnet wurden.',
    /** */

    /**
     * National
     */
    'SHIPPING_NATIONAL_START_TITLE'                            => 'Nationaler Versand',
    'SHIPPING_NATIONAL_START_DESC'                             => 'Hier befinden sich alle Einstellungen bezüglich des nationalen Versands. Klicken Sie auf die Gruppe um die Einstellungen zu öffnen.',

    'SHIPPING_NATIONAL_COUNTRY_TITLE'                          => 'Nationaler Versand',
    'SHIPPING_NATIONAL_COUNTRY_DESC'                           => sprintf(
        'Standort des Online Shops ist aktuell %s und kann unter %s angepasst werden.',
        $country['countries_name'] ?? 'Unbekannt',
        sprintf(
            '<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s -> %s</a>',
            defined('BOX_HEADING_CONFIGURATION') ? BOX_HEADING_CONFIGURATION : 'BOX_HEADING_CONFIGURATION',
            defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1',
        )
    ),
    'SHIPPING_NATIONAL_COSTS_TITLE'                            => 'Nationale Versand Kosten',
    'SHIPPING_NATIONAL_COSTS_DESC'                             => 'Zuordnung der Versandkosten für verschiedene Gewichte.',

    'SHIPPING_NATIONAL_WEIGHT_TITLE'                           => 'Gewicht',
    'SHIPPING_NATIONAL_WEIGHT_DESC'                            => 'Maximal zulässiges Gewicht (in Kg) für diesen Preis.',
    'SHIPPING_NATIONAL_COST_TITLE'                             => 'Kosten',
    'SHIPPING_NATIONAL_COST_DESC'                              => 'Versandkosten für Gewicht in EUR.',

    'SHIPPING_NATIONAL_BUTTON_ADD'                             => 'Hinzufügen',
    'SHIPPING_NATIONAL_BUTTON_APPLY'                           => 'Übernehmen',
    'SHIPPING_NATIONAL_BUTTON_CANCEL'                          => 'Abbrechen',

    'SHIPPING_NATIONAL_END_TITLE'                              => '',
    'SHIPPING_NATIONAL_END_DESC'                               => '',
    /** */

    /**
     * International
     */
    'SHIPPING_INTERNATIONAL_START_TITLE'                       => 'Internationaler Versand',
    'SHIPPING_INTERNATIONAL_START_DESC'                        => 'Hier befinden sich alle Einstellungen bezüglich des internationalen Versands. Klicken Sie auf die Gruppe um die Einstellungen zu öffnen.',

    /** Premium */
    'SHIPPING_INTERNATIONAL_PREMIUM_START_TITLE'               => 'Premium Versand',
    'SHIPPING_INTERNATIONAL_PREMIUM_START_DESC'                => 'Hier befinden sich alle Einstellungen bezüglich des internationalen permium Versands. Klicken Sie auf die Gruppe um die Einstellungen zu öffnen.',

    'SHIPPING_INTERNATIONAL_PREMIUM_ENABLE_TITLE'              => 'Premium Versand aktivieren?',
    'SHIPPING_INTERNATIONAL_PREMIUM_ENABLE_DESC'               => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU_TITLE'    => 'Zone 1 Premium Basispreis (EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU_TITLE' => 'Zone 1 Premium Basispreis (Nicht EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU_TITLE'      => 'Zone 1 Premium Kilogrammpreis (EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU_TITLE'   => 'Zone 1 Premium Kilogrammpreis (Nicht EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE_TITLE'       => 'Zone 2 Premium Basispreis',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG_TITLE'         => 'Zone 2 Premium Kilogrammpreis',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU_TITLE'    => 'Zone 3 Premium Basispreis (EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU_TITLE' => 'Zone 3 Premium Basispreis (Nicht EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU_TITLE'      => 'Zone 3 Premium Kilogrammpreis (EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU_TITLE'   => 'Zone 3 Premium Kilogrammpreis (Nicht EU)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE_TITLE'       => 'Zone 4 Premium Basispreis',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG_TITLE'         => 'Zone 4 Premium Kilogrammpreis',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE_TITLE'       => 'Zone 5 Premium Basispreis',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG_TITLE'         => 'Zone 5 Premium Kilogrammpreis',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE_TITLE'       => 'Zone 6 Premium Basispreis',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG_TITLE'         => 'Zone 6 Premium Kilogrammpreis',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_END_TITLE'                 => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_END_DESC'                  => '',

    /** Economy */
    'SHIPPING_INTERNATIONAL_ECONOMY_START_TITLE'               => 'Economy Versand',
    'SHIPPING_INTERNATIONAL_ECONOMY_START_DESC'                => 'Hier befinden sich alle Einstellungen bezüglich des internationalen economy Versands. Klicken Sie auf die Gruppe um die Einstellungen zu öffnen.',

    'SHIPPING_INTERNATIONAL_ECONOMY_ENABLE_TITLE'              => 'Economy Versand aktivieren?',
    'SHIPPING_INTERNATIONAL_ECONOMY_ENABLE_DESC'               => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU_TITLE'    => 'Zone 1 Economy Basispreis (EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU_TITLE' => 'Zone 1 Economy Basispreis (Nicht EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU_TITLE'      => 'Zone 1 Economy Kilogrammpreis (EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU_TITLE'   => 'Zone 1 Economy Kilogrammpreis (Nicht EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE_TITLE'       => 'Zone 2 Economy Basispreis',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG_TITLE'         => 'Zone 2 Economy Kilogrammpreis',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU_TITLE'    => 'Zone 3 Economy Basispreis (EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU_TITLE' => 'Zone 3 Economy Basispreis (Nicht EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU_TITLE'      => 'Zone 3 Economy Kilogrammpreis (EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU_TITLE'   => 'Zone 3 Economy Kilogrammpreis (Nicht EU)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE_TITLE'       => 'Zone 4 Economy Basispreis',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG_TITLE'         => 'Zone 4 Economy Kilogrammpreis',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE_TITLE'       => 'Zone 5 Economy Basispreis',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG_TITLE'         => 'Zone 5 Economy Kilogrammpreis',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE_TITLE'       => 'Zone 6 Economy Basispreis',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG_TITLE'         => 'Zone 6 Economy Kilogrammpreis',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_END_TITLE'                 => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_END_DESC'                  => '',

    'SHIPPING_INTERNATIONAL_END_TITLE'                         => '',
    'SHIPPING_INTERNATIONAL_END_DESC'                          => '',

    /**
     * Surcharges
     */
    'SURCHARGES_START_TITLE'                                   => 'Aufschläge',
    'SURCHARGES_START_DESC'                                    => 'Hier befinden sich alle Einstellungen bezüglich der Aufschläge. Klicken Sie auf die Gruppe um die Einstellungen zu öffnen.',

    'SURCHARGES_TITLE'                                         => 'Aufschläge',
    'SURCHARGES_DESC'                                          => '',

    'SURCHARGES_NAME_TITLE'                                    => 'Name',
    'SURCHARGES_NAME_DESC'                                     => 'Bezeichnung für den Aufschlag.',
    'SURCHARGES_SURCHARGE_TITLE'                               => 'Aufschlag',
    'SURCHARGES_SURCHARGE_DESC'                                => 'Wie hoch ist der Aufschlag?',
    'SURCHARGES_TYPE_TITLE'                                    => 'Art',
    'SURCHARGES_TYPE_DESC'                                     => 'Um was für einen Aufschlag handelt es sich?',
    'SURCHARGES_TYPE_FIXED'                                    => 'Fest',
    'SURCHARGES_TYPE_PERCENT'                                  => 'Prozentual',
    'SURCHARGES_DURATION_START_TITLE'                          => 'Von',
    'SURCHARGES_DURATION_START_DESC'                           => 'Optional. Ab wann der Zuschlag gelten soll. Jahreszahlen aktualisieren sich automatisch.',
    'SURCHARGES_DURATION_END_TITLE'                            => 'Bis',
    'SURCHARGES_DURATION_END_DESC'                             => 'Optional. Bis wann der Zuschlag gelten soll. Jahreszahlen aktualisieren sich automatisch.',

    'SURCHARGES_ROUND_UP_TITLE'                                => 'Versandkosten aufrunden?',
    'SURCHARGES_ROUND_UP_DESC'                                 => 'Ermöglicht es die Versandkosten einheitlicher darzustellen, indem die Beträge immer (auf z. B. XX,90 €) aufgerundet werden.',
    'SURCHARGES_ROUND_UP_TO_TITLE'                             => 'Aufrunden auf',
    'SURCHARGES_ROUND_UP_TO_DESC'                              => 'Auf welche Nachkommastelle soll immer aufgerundet werden?',

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
