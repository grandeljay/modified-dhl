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
    'LONG_DESCRIPTION'                                         => 'Método de envío DHL',
    'STATUS_TITLE'                                             => '¿Activar módulo?',
    'STATUS_DESC'                                              => 'Permite el envío a través de DHL.',
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
    'SHIPPING_NATIONAL_START_TITLE'                            => 'Transporte marítimo nacional',
    'SHIPPING_NATIONAL_START_DESC'                             => 'Aquí encontrará todos los ajustes relativos al envío nacional. Pulse sobre el grupo para abrir los ajustes.',

    'SHIPPING_NATIONAL_COUNTRY_TITLE'                          => 'Transporte marítimo nacional',
    'SHIPPING_NATIONAL_COUNTRY_DESC'                           => sprintf(
        'La posizione del negozio online è attualmente %s e può essere modificata sotto %s.',
        $country['countries_name'] ?? 'Desconocido',
        sprintf(
            '<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s -> %s</a>',
            defined('BOX_HEADING_CONFIGURATION') ? BOX_HEADING_CONFIGURATION : 'BOX_HEADING_CONFIGURATION',
            defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1',
        )
    ),
    'SHIPPING_NATIONAL_COSTS_TITLE'                            => 'Gastos de envío nacionales',
    'SHIPPING_NATIONAL_COSTS_DESC'                             => 'Asignación de gastos de envío para distintos pesos.',

    'SHIPPING_NATIONAL_WEIGHT_TITLE'                           => 'Peso',
    'SHIPPING_NATIONAL_WEIGHT_DESC'                            => 'Peso máximo autorizado (en kg) para este precio.',
    'SHIPPING_NATIONAL_COST_TITLE'                             => 'Costes',
    'SHIPPING_NATIONAL_COST_DESC'                              => 'Gastos de envío por peso en EUR.',

    'SHIPPING_NATIONAL_BUTTON_ADD'                             => 'Añada',
    'SHIPPING_NATIONAL_BUTTON_APPLY'                           => 'Asumir',
    'SHIPPING_NATIONAL_BUTTON_CANCEL'                          => 'Cancelar',

    'SHIPPING_NATIONAL_END_TITLE'                              => '',
    'SHIPPING_NATIONAL_END_DESC'                               => '',

    /**
     * International
     */
    'SHIPPING_INTERNATIONAL_START_TITLE'                       => 'Envíos internacionales',
    'SHIPPING_INTERNATIONAL_START_DESC'                        => 'Aquí encontrará todos los ajustes relativos a los envíos internacionales. Pulse sobre el grupo para abrir los ajustes.',

    /** Premium */
    'SHIPPING_INTERNATIONAL_PREMIUM_START_TITLE'               => 'Envío Premium',
    'SHIPPING_INTERNATIONAL_PREMIUM_START_DESC'                => 'Aquí encontrará todos los ajustes relativos al envío internacional permium. Pulse sobre el grupo para abrir los ajustes.',

    'SHIPPING_INTERNATIONAL_PREMIUM_ENABLE_TITLE'              => '¿Activar el envío Premium?',
    'SHIPPING_INTERNATIONAL_PREMIUM_ENABLE_DESC'               => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU_TITLE'    => 'Zona 1 Prima Precio base (UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU_TITLE' => 'Zona 1 Prima Precio Base (No UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU_TITLE'      => 'Zona 1 Prima Precio por kilogramo (UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU_TITLE'   => 'Zona 1 Precio premium por kilogramo (no UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE_TITLE'       => 'Zona 2 Premium Precio base',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG_TITLE'         => 'Zona 2 Premium Precio por kilogramo',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU_TITLE'    => 'Zona 3 Precio base premium (UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU_TITLE' => 'Zona 3 Precio base premium (no UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU_TITLE'      => 'Zona 3 Precio premium por kilogramo (UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU_TITLE'   => 'Zona 3 Precio premium por kilogramo (no UE)',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE_TITLE'       => 'Zona 4 Premium Precio base',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG_TITLE'         => 'Zona 4 Premium Precio por kilogramo',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE_TITLE'       => 'Zona 5 Premium Precio base',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG_TITLE'         => 'Zona 5 Premium Precio por kilogramo',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE_TITLE'       => 'Zona 6 Premium Precio base',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG_TITLE'         => 'Zona 6 Premium Precio por kilogramo',
    'SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_PREMIUM_END_TITLE'                 => '',
    'SHIPPING_INTERNATIONAL_PREMIUM_END_DESC'                  => '',

    /** Economy */
    'SHIPPING_INTERNATIONAL_ECONOMY_START_TITLE'               => 'Envío económico',
    'SHIPPING_INTERNATIONAL_ECONOMY_START_DESC'                => 'Aquí encontrará todos los ajustes relacionados con el envío internacional económico. Pulse sobre el grupo para abrir los ajustes.',

    'SHIPPING_INTERNATIONAL_ECONOMY_ENABLE_TITLE'              => '¿Activar el envío económico?',
    'SHIPPING_INTERNATIONAL_ECONOMY_ENABLE_DESC'               => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU_TITLE'    => 'Precio base económico de la zona 1 (UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU_TITLE' => 'Zona 1 Precio base económico (no UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU_TITLE'      => 'Zona 1 Económica Precio por kilogramo (UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU_TITLE'   => 'Zona 1 Precio económico por kilogramo (no UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE_TITLE'       => 'Zona 2 Precio base económico',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG_TITLE'         => 'Zona 2 Precio económico por kilogramo',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU_TITLE'    => 'Precio base económico de la zona 3 (UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU_DESC'     => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU_TITLE' => 'Zona 3 Precio base económico (no UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU_DESC'  => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU_TITLE'      => 'Zona 3 Económica Precio por kilogramo (UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU_DESC'       => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU_TITLE'   => 'Zona 3 Precio económico por kilogramo (no UE)',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU_DESC'    => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE_TITLE'       => 'Zona 4 Precio base económico',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG_TITLE'         => 'Zona 4 Precio económico por kilogramo',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE_TITLE'       => 'Zona 5 Precio base económico',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG_TITLE'         => 'Zona 5 Precio económico por kilogramo',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE_TITLE'       => 'Zona 6 Precio base económico',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE_DESC'        => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG_TITLE'         => 'Zona 6 Precio económico por kilogramo',
    'SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG_DESC'          => '',

    'SHIPPING_INTERNATIONAL_ECONOMY_END_TITLE'                 => '',
    'SHIPPING_INTERNATIONAL_ECONOMY_END_DESC'                  => '',

    'SHIPPING_INTERNATIONAL_END_TITLE'                         => '',
    'SHIPPING_INTERNATIONAL_END_DESC'                          => '',

    /**
     * Surcharges
     */
    'SURCHARGES_START_TITLE'                                   => 'Impactos',
    'SURCHARGES_START_DESC'                                    => 'Aquí encontrará todos los ajustes relativos a los recargos. Pulse sobre el grupo para abrir los ajustes.',

    'SURCHARGES_TITLE'                                         => 'Impactos',
    'SURCHARGES_DESC'                                          => '',

    'SURCHARGES_NAME_TITLE'                                    => 'Nombre',
    'SURCHARGES_NAME_DESC'                                     => 'Término para el saque.',
    'SURCHARGES_SURCHARGE_TITLE'                               => 'Impacto',
    'SURCHARGES_SURCHARGE_DESC'                                => '¿A cuánto asciende el recargo?',
    'SURCHARGES_TYPE_TITLE'                                    => 'Arte',
    'SURCHARGES_TYPE_DESC'                                     => '¿De qué tipo de recargo estamos hablando?',
    'SURCHARGES_TYPE_FIXED'                                    => 'Fijo',
    'SURCHARGES_TYPE_PERCENT'                                  => 'Porcentaje',
    'SURCHARGES_DURATION_START_TITLE'                          => 'En',
    'SURCHARGES_DURATION_START_DESC'                           => 'Opcional. A partir de cuándo debe aplicarse el recargo. Los números anuales se actualizan automáticamente.',
    'SURCHARGES_DURATION_END_TITLE'                            => 'Hasta',
    'SURCHARGES_DURATION_END_DESC'                             => 'Opcional. Hasta cuándo se aplicará el recargo. Los números anuales se actualizan automáticamente.',

    'SURCHARGES_ROUND_UP_TITLE'                                => '¿Redondear los gastos de envío?',
    'SURCHARGES_ROUND_UP_DESC'                                 => 'Permite que los gastos de envío se muestren de forma más uniforme redondeando siempre los importes al alza (hasta, por ejemplo, XX,90 €).',
    'SURCHARGES_ROUND_UP_TO_TITLE'                             => 'Redondee hasta',
    'SURCHARGES_ROUND_UP_TO_DESC'                              => '¿A qué decimal debe redondearse siempre?',

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
