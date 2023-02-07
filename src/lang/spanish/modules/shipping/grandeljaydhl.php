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

$translations_general = array(
    /**
     * Module
     */
    'TITLE'                                                              => 'grandeljay - DHL',
    'LONG_DESCRIPTION'                                                   => 'Método de envío DHL',
    'STATUS_TITLE'                                                       => '¿Activar módulo?',
    'STATUS_DESC'                                                        => 'Permite el envío a través de DHL.',
    'TEXT_TITLE'                                                         => 'DHL',

    /**
     * Required for modified compatibility
     */
    'ALLOWED_TITLE'                                                      => '',
    'ALLOWED_DESC'                                                       => '',

    /**
     * Debug
     */
    'DEBUG_ENABLE_TITLE'                                                 => 'Modo depuración',
    'DEBUG_ENABLE_DESC'                                                  => '¿Activar el modo de depuración? Se muestra información adicional, por ejemplo, cómo se han calculado los gastos de envío. Sólo visible para los administradores.',

    /**
     * Weight
     */
    Group::SHIPPING_WEIGHT . '_START_TITLE'                              => 'Peso',
    Group::SHIPPING_WEIGHT . '_START_DESC'                               => 'Aquí encontrará todos los ajustes relativos al embalaje y al peso. Pulse sobre el grupo para abrir los ajustes.',

    Group::SHIPPING_WEIGHT . '_MAX_TITLE'                                => 'Peso máximo',
    Group::SHIPPING_WEIGHT . '_MAX_DESC'                                 => 'Peso máximo que puede tener un artículo.',
    Group::SHIPPING_WEIGHT . '_IDEAL_TITLE'                              => 'Peso ideal',
    Group::SHIPPING_WEIGHT . '_IDEAL_DESC'                               => 'Peso objetivo al calcular los gastos de envío, por ejemplo, para aumentar la seguridad del transporte.',

    Group::SHIPPING_WEIGHT . '_END_TITLE'                                => '',
    Group::SHIPPING_WEIGHT . '_END_DESC'                                 => '',

    /**
     * National
     */
    Group::SHIPPING_NATIONAL . '_START_TITLE'                            => 'Transporte marítimo nacional',
    Group::SHIPPING_NATIONAL . '_START_DESC'                             => 'Aquí encontrará todos los ajustes relativos al envío nacional. Pulse sobre el grupo para abrir los ajustes.',

    Group::SHIPPING_NATIONAL . '_COUNTRY_TITLE'                          => 'Transporte marítimo nacional',
    Group::SHIPPING_NATIONAL . '_COUNTRY_DESC'                           => sprintf(
        'La posizione del negozio online è attualmente %s e può essere modificata sotto %s.',
        $country['countries_name'] ?? 'Desconocido',
        sprintf(
            '<a href="/' . DIR_ADMIN . 'configuration.php?gID=1">%s -> %s</a>',
            defined('BOX_HEADING_CONFIGURATION') ? BOX_HEADING_CONFIGURATION : 'BOX_HEADING_CONFIGURATION',
            defined('BOX_CONFIGURATION_1') ? BOX_CONFIGURATION_1 : 'BOX_CONFIGURATION_1',
        )
    ),
    Group::SHIPPING_NATIONAL . '_COSTS_TITLE'                            => 'Gastos de envío nacionales',
    Group::SHIPPING_NATIONAL . '_COSTS_DESC'                             => 'Asignación de gastos de envío para distintos pesos.',

    Group::SHIPPING_NATIONAL . '_WEIGHT_TITLE'                           => 'Peso',
    Group::SHIPPING_NATIONAL . '_WEIGHT_DESC'                            => 'Peso máximo autorizado (en kg) para este precio.',
    Group::SHIPPING_NATIONAL . '_COST_TITLE'                             => 'Costes',
    Group::SHIPPING_NATIONAL . '_COST_DESC'                              => 'Gastos de envío por peso en EUR.',

    Group::SHIPPING_NATIONAL . '_BUTTON_ADD'                             => 'Añada',
    Group::SHIPPING_NATIONAL . '_BUTTON_APPLY'                           => 'Asumir',
    Group::SHIPPING_NATIONAL . '_BUTTON_CANCEL'                          => 'Cancelar',

    Group::SHIPPING_NATIONAL . '_END_TITLE'                              => '',
    Group::SHIPPING_NATIONAL . '_END_DESC'                               => '',

    /**
     * International
     */
    Group::SHIPPING_INTERNATIONAL . '_START_TITLE'                       => 'Envíos internacionales',
    Group::SHIPPING_INTERNATIONAL . '_START_DESC'                        => 'Aquí encontrará todos los ajustes relativos a los envíos internacionales. Pulse sobre el grupo para abrir los ajustes.',

    /** Premium */
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_START_TITLE'               => 'Envío Premium',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_START_DESC'                => 'Aquí encontrará todos los ajustes relativos al envío internacional permium. Pulse sobre el grupo para abrir los ajustes.',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_ENABLE_TITLE'              => '¿Activar el envío Premium?',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_ENABLE_DESC'               => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_EU_TITLE'    => 'Zona 1 Prima Precio base (UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_NONEU_TITLE' => 'Zona 1 Prima Precio Base (No UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_EU_TITLE'      => 'Zona 1 Prima Precio por kilogramo (UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_NONEU_TITLE'   => 'Zona 1 Precio premium por kilogramo (no UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_BASE_TITLE'       => 'Zona 2 Premium Precio base',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_KG_TITLE'         => 'Zona 2 Premium Precio por kilogramo',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_EU_TITLE'    => 'Zona 3 Precio base premium (UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_NONEU_TITLE' => 'Zona 3 Precio base premium (no UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_EU_TITLE'      => 'Zona 3 Precio premium por kilogramo (UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_NONEU_TITLE'   => 'Zona 3 Precio premium por kilogramo (no UE)',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_BASE_TITLE'       => 'Zona 4 Premium Precio base',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_KG_TITLE'         => 'Zona 4 Premium Precio por kilogramo',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_BASE_TITLE'       => 'Zona 5 Premium Precio base',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_KG_TITLE'         => 'Zona 5 Premium Precio por kilogramo',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_BASE_TITLE'       => 'Zona 6 Premium Precio base',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_KG_TITLE'         => 'Zona 6 Premium Precio por kilogramo',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_END_TITLE'                 => '',
    Group::SHIPPING_INTERNATIONAL . '_PREMIUM_END_DESC'                  => '',

    /** Economy */
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_START_TITLE'               => 'Envío económico',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_START_DESC'                => 'Aquí encontrará todos los ajustes relacionados con el envío internacional económico. Pulse sobre el grupo para abrir los ajustes.',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_ENABLE_TITLE'              => '¿Activar el envío económico?',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_ENABLE_DESC'               => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_EU_TITLE'    => 'Precio base económico de la zona 1 (UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_NONEU_TITLE' => 'Zona 1 Precio base económico (no UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_EU_TITLE'      => 'Zona 1 Económica Precio por kilogramo (UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_NONEU_TITLE'   => 'Zona 1 Precio económico por kilogramo (no UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_BASE_TITLE'       => 'Zona 2 Precio base económico',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_KG_TITLE'         => 'Zona 2 Precio económico por kilogramo',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_EU_TITLE'    => 'Precio base económico de la zona 3 (UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_EU_DESC'     => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_NONEU_TITLE' => 'Zona 3 Precio base económico (no UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_NONEU_DESC'  => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_EU_TITLE'      => 'Zona 3 Económica Precio por kilogramo (UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_EU_DESC'       => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_NONEU_TITLE'   => 'Zona 3 Precio económico por kilogramo (no UE)',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_NONEU_DESC'    => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_BASE_TITLE'       => 'Zona 4 Precio base económico',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_KG_TITLE'         => 'Zona 4 Precio económico por kilogramo',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_BASE_TITLE'       => 'Zona 5 Precio base económico',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_KG_TITLE'         => 'Zona 5 Precio económico por kilogramo',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_BASE_TITLE'       => 'Zona 6 Precio base económico',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_BASE_DESC'        => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_KG_TITLE'         => 'Zona 6 Precio económico por kilogramo',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_KG_DESC'          => '',

    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_END_TITLE'                 => '',
    Group::SHIPPING_INTERNATIONAL . '_ECONOMY_END_DESC'                  => '',

    Group::SHIPPING_INTERNATIONAL . '_END_TITLE'                         => '',
    Group::SHIPPING_INTERNATIONAL . '_END_DESC'                          => '',

    /**
     * Surcharges
     */
    Group::SURCHARGES . '_START_TITLE'                                   => 'Impactos',
    Group::SURCHARGES . '_START_DESC'                                    => 'Aquí encontrará todos los ajustes relativos a los recargos. Pulse sobre el grupo para abrir los ajustes.',

    Group::SURCHARGES . '_TITLE'                                         => 'Impactos',
    Group::SURCHARGES . '_DESC'                                          => '',

    Group::SURCHARGES . '_NAME_TITLE'                                    => 'Nombre',
    Group::SURCHARGES . '_NAME_DESC'                                     => 'Término para el saque.',
    Group::SURCHARGES . '_SURCHARGE_TITLE'                               => 'Impacto',
    Group::SURCHARGES . '_SURCHARGE_DESC'                                => '¿A cuánto asciende el recargo?',
    Group::SURCHARGES . '_TYPE_TITLE'                                    => 'Arte',
    Group::SURCHARGES . '_TYPE_DESC'                                     => '¿De qué tipo de recargo estamos hablando?',
    Group::SURCHARGES . '_TYPE_FIXED'                                    => 'Fijo',
    Group::SURCHARGES . '_TYPE_PERCENT'                                  => 'Porcentaje',
    Group::SURCHARGES . '_PER_PACKAGE_TITLE'                             => 'Por envase',
    Group::SURCHARGES . '_PER_PACKAGE_DESC'                              => 'El recargo se calcula para cada paquete.',
    Group::SURCHARGES . '_DURATION_START_TITLE'                          => 'En',
    Group::SURCHARGES . '_DURATION_START_DESC'                           => 'Opcional. A partir de cuándo debe aplicarse el recargo. Los números anuales se actualizan automáticamente.',
    Group::SURCHARGES . '_DURATION_END_TITLE'                            => 'Hasta',
    Group::SURCHARGES . '_DURATION_END_DESC'                             => 'Opcional. Hasta cuándo se aplicará el recargo. Los números anuales se actualizan automáticamente.',

    Group::SURCHARGES . '_PICK_AND_PACK_TITLE'                           => 'Recoger y envasar',
    Group::SURCHARGES . '_PICK_AND_PACK_DESC'                            => 'Gastos de montaje y embalaje del pedido.',

    Group::SURCHARGES . '_ROUND_UP_TITLE'                                => '¿Redondear los gastos de envío?',
    Group::SURCHARGES . '_ROUND_UP_DESC'                                 => 'Permite que los gastos de envío se muestren de forma más uniforme redondeando siempre los importes al alza (hasta, por ejemplo, XX,90 €).',
    Group::SURCHARGES . '_ROUND_UP_TO_TITLE'                             => 'Redondee hasta',
    Group::SURCHARGES . '_ROUND_UP_TO_DESC'                              => '¿A qué decimal debe redondearse siempre?',

    Group::SURCHARGES . '_END_TITLE'                                     => '',
    Group::SURCHARGES . '_END_DESC'                                      => '',
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
