<?php

/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

use RobinTheHood\ModifiedStdModule\Classes\{Configuration, StdModule};

/**
 * Shipping methods musn't contain underscores.
 */
class grandeljaydhl extends StdModule
{
    public const VERSION = '0.1.0';
    public const NAME    = 'MODULE_SHIPPING_GRANDELJAYDHL';

    private static Configuration $config;

    /**
     * Cannot make non static method
     * RobinTheHood\ModifiedStdModule\Classes\StdModule::getConfig() static
     *
     * @return void
     */
    private static function _getConfig()
    {
        if (!isset(self::$config)) {
            self::$config = new Configuration(self::NAME);
        }

        return self::$config;
    }

    private static function groupStart(string $value, string $option): string
    {
        ob_start();
        ?>
        <details>
            <summary><h2><?= constant($option) ?></h2></summary>
            <div>
        <?php
        return ob_get_clean();
    }

    private static function groupEnd(string $value, string $option): string
    {
        ob_start();
        ?>
            </div>
        </details>
        <?php
        return ob_get_clean();
    }

    /**
     * National
     */
    public static function nationalStartSet(string $value, string $option): string
    {
        return self::groupStart($value, $option);
    }

    public static function nationalEndSet(string $value, string $option): string
    {
        return self::groupEnd($value, $option);
    }

    public static function nationalCountrySet(string $countryID, string $option): string
    {
        $html  = '';
        $html .= xtc_draw_input_field(
            'configuration[' . $option . ']',
            $countryID,
            'readonly="true"
             style="opacity: 0.4;"'
        );

        return $html;
    }

    public static function nationalCostsSet(string $value, string $option): string
    {
        $value = html_entity_decode($value, ENT_QUOTES | ENT_HTML5);

        $html  = '';
        $html .= xtc_draw_input_field(
            'configuration[' . $option . ']',
            $value
        );

        ob_start();
        ?>
        <dialog id="<?= $option ?>">
            <div class="modulbox">
                <table class="contentTable">
                    <tbody>
                        <tr class="infoBoxHeading">
                            <td class="infoBoxHeading">
                                <div class="infoBoxHeadingTitle"><b><?= self::_getConfig()->shippingNationalCostsTitle ?></b></div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="contentTable">
                    <tbody>
                        <tr class="infoBoxContent">
                            <td class="infoBoxContent">
                                <div class="container">
                                    <template id="grandeljaydhl_row">
                                        <div class="row">
                                            <div class="column">
                                                <input type="text" pattern="[\d\.]+" class="weight" /> Kg
                                            </div>

                                            <div class="column">
                                                <input type="text" pattern="[\d\.]+" class="cost" /> EUR
                                            </div>
                                        </div>
                                    </template>

                                    <div class="row">
                                        <div class="column">
                                            <div>
                                                <b><?= self::_getConfig()->shippingNationalWeightTitle ?></b><br>
                                                <?= self::_getConfig()->shippingNationalWeightDesc ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= self::_getConfig()->shippingNationalCostTitle ?></b><br>
                                                <?= self::_getConfig()->shippingNationalCostDesc ?><br>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $shipping_costs = json_decode($value, true);

                                    foreach ($shipping_costs as $weight_kg => $cost) {
                                        preg_match('/[\d\.]+/', $weight_kg, $weight);
                                        $weight = floatval(reset($weight));
                                        ?>
                                        <div class="row">
                                            <div class="column">
                                                <input type="text" value="<?= $weight ?>" pattern="[\d\.]+" class="weight" /> Kg
                                            </div>

                                            <div class="column">
                                                <input type="text" value="<?= $cost ?>" pattern="[\d\.]+" class="cost" /> EUR
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="row">
                                        <button name="grandeljaydhl_add"><?= self::_getConfig()->shippingNationalButtonAdd ?></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="buttons">
                <button name="grandeljaydhl_apply" value="default"><?= self::_getConfig()->shippingNationalButtonApply ?></button>
                <button name="grandeljaydhl_cancel" value="cancel" type="button"><?= self::_getConfig()->shippingNationalButtonCancel ?></button>
            </div>
        </dialog>
        <?php
        $html .= ob_get_clean();

        return $html;
    }
    /** */

    /**
     * International
     */
    public static function internationalStartSet(string $value, string $option): string
    {
        return self::groupStart($value, $option);
    }

    public static function internationalEndSet(string $value, string $option): string
    {
        return self::groupEnd($value, $option);
    }
    /** */

    /**
     * Surcharges
     */
    public static function surchargesStartSet(string $value, string $option): string
    {
        return self::groupStart($value, $option);
    }

    public static function surchargesEndSet(string $value, string $option): string
    {
        return self::groupEnd($value, $option);
    }

    public static function surchargesSet(string $value, string $option): string
    {
        $value = html_entity_decode($value, ENT_QUOTES | ENT_HTML5);

        $html  = '';
        $html .= xtc_draw_input_field(
            'configuration[' . $option . ']',
            $value
        );

        ob_start();
        ?>
        <dialog id="<?= $option ?>">
            <div class="modulbox">
                <table class="contentTable">
                    <tbody>
                        <tr class="infoBoxHeading">
                            <td class="infoBoxHeading">
                                <div class="infoBoxHeadingTitle"><b><?= self::_getConfig()->surchargesTitle ?></b></div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="contentTable">
                    <tbody>
                        <tr class="infoBoxContent">
                            <td class="infoBoxContent">
                                <div class="container">
                                    <template id="grandeljaydhl_row">
                                        <div class="row">
                                            <div class="column">
                                                <input type="text" class="name" />
                                            </div>

                                            <div class="column">
                                                <input type="number" step="0.1" class="surcharge" />
                                            </div>

                                            <div class="column">
                                                <select class="type">
                                                    <option value="fixed"><?= self::_getConfig()->surchargesTypeFixed ?></option>
                                                    <option value="percent"><?= self::_getConfig()->surchargesTypePercent ?></option>
                                                </select>
                                            </div>

                                            <?php
                                            $regex_dd_mm = '^(01|02|03|04|05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|24|26|27|28|29|30|31)\.(01|02|03|04|05|06|07|08|09|10|11|12)\.$'
                                            ?>

                                            <div class="column">
                                                <input type="text" class="duration" pattern="<?= $regex_dd_mm ?>" />
                                            </div>

                                            <div class="column">
                                                <input type="text" class="duration" pattern="<?= $regex_dd_mm ?>" />
                                            </div>
                                        </div>
                                    </template>

                                    <div class="row">
                                        <div class="column">
                                            <div>
                                                <b><?= self::_getConfig()->surchargesNameTitle ?></b><br>
                                                <?= self::_getConfig()->surchargesNameDesc ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= self::_getConfig()->surchargesSurchargeTitle ?></b><br>
                                                <?= self::_getConfig()->surchargesSurchargeDesc ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= self::_getConfig()->surchargesTypeTitle ?></b><br>
                                                <?= self::_getConfig()->surchargesTypeDesc ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= self::_getConfig()->surchargesDurationStartTitle ?></b><br>
                                                <?= self::_getConfig()->surchargesDurationStartDesc ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= self::_getConfig()->surchargesDurationEndTitle ?></b><br>
                                                <?= self::_getConfig()->surchargesDurationEndDesc ?><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <button name="grandeljaydhl_add"><?= self::_getConfig()->shippingNationalButtonAdd ?></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="buttons">
                <button name="grandeljaydhl_apply" value="default"><?= self::_getConfig()->shippingNationalButtonApply ?></button>
                <button name="grandeljaydhl_cancel" value="cancel" type="button"><?= self::_getConfig()->shippingNationalButtonCancel ?></button>
            </div>
        </dialog>
        <?php
        $html .= ob_get_clean();

        return $html;
    }
    /** */

    public function __construct()
    {
        $this->init(self::NAME);
        $this->checkForUpdate(true);

        /**
         * National
         */
        $this->addKey('SHIPPING_NATIONAL_START');
        $this->addKey('SHIPPING_NATIONAL_COUNTRY');
        $this->addKey('SHIPPING_NATIONAL_COSTS');
        $this->addKey('SHIPPING_NATIONAL_END');
        /** */

        /**
         * International
         */
        $this->addKey('SHIPPING_INTERNATIONAL_START');

        /** Premium */
        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU');
        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU');
        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU');
        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU');

        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE');
        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG');

        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU');
        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU');
        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU');
        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU');

        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE');
        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG');

        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE');
        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG');

        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE');
        $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG');

        /** Economy */
        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU');
        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU');
        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU');
        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU');

        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE');
        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG');

        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU');
        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU');
        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU');
        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU');

        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE');
        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG');

        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE');
        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG');

        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE');
        $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG');

        $this->addKey('SHIPPING_INTERNATIONAL_END');
        /** */

        /**
         * Surcharges
         */
        $this->addKey('SURCHARGES_START');

        $this->addKey('SURCHARGES');

        $this->addKey('SURCHARGES_END');
        /** */
    }

    public function install()
    {
        parent::install();

        $prices_national = json_encode(
            array(
                '20.0' => '4.06',
                '31.5' => '4.90',
            )
        );

        /**
         * National
         */
        $this->addConfiguration('SHIPPING_NATIONAL_START', self::_getConfig()->shippingNationalStartTitle, 6, 1, self::class . '::nationalStartSet(');

        $this->addConfiguration('SHIPPING_NATIONAL_COUNTRY', STORE_COUNTRY, 6, 1, self::class . '::nationalCountrySet(');
        $this->addConfiguration('SHIPPING_NATIONAL_COSTS', $prices_national, 6, 1, self::class . '::nationalCostsSet(');

        $this->addConfiguration('SHIPPING_NATIONAL_END', '', 6, 1, self::class . '::nationalEndSet(');
        /** */

        /**
         * International
         */
        $this->addConfiguration('SHIPPING_INTERNATIONAL_START', self::_getConfig()->shippingInternationalStartTitle, 6, 1, self::class . '::internationalStartSet(');

        /** Premium */
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU', 10.44, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU', 19.40, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU', 0.64, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU', 1.00, 6, 1);

        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE', 10.76, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG', 0.75, 6, 1);

        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU', 10.97, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU', 17.79, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU', 0.85, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU', 1.81, 6, 1);

        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE', 24.45, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG', 2.70, 6, 1);

        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE', 26.30, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG', 6.00, 6, 1);

        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE', 35.90, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG', 7.30, 6, 1);

        /** Economy */
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU', 10.15, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU', 0.70, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU', 14.48, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU', 0.27, 6, 1);

        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE', 10.70, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG', 0.80, 6, 1);

        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU', 10.90, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU', 1.00, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU', 13.90, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU', 1.00, 6, 1);

        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE', 23.80, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG', 1.40, 6, 1);

        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE', 26.30, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG', 3.30, 6, 1);

        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE', 31.85, 6, 1);
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG', 3.20, 6, 1);

        $this->addConfiguration('SHIPPING_INTERNATIONAL_END', '', 6, 1, self::class . '::internationalEndSet(');
        /** */

        /**
         * Surcharges
         */
        $this->addConfiguration('SURCHARGES_START', self::_getConfig()->surchargesStartTitle, 6, 1, self::class . '::surchargesStartSet(');

        $surcharges = json_encode(
            array(
                'energy' => array(
                    'name'      => 'Energiezuschlag',
                    'surcharge' => 3.75,
                    'type'      => 'percent',
                ),
                'toll'   => array(
                    'name'      => 'Maut',
                    'surcharge' => 0.12,
                    'type'      => 'fixed',
                ),
                'peak'   => array(
                    'name'      => 'Maut',
                    'surcharge' => 0.19,
                    'type'      => 'fixed',
                    'duration'  => array(
                        'start' => '31.10',
                        'end'   => '15.01',
                    ),
                ),
            )
        );

        $this->addConfiguration('SURCHARGES', $surcharges, 6, 1, self::class . '::surchargesSet(');

        $this->addConfiguration('SURCHARGES_END', '', 6, 1, self::class . '::surchargesEndSet(');
        /** */
    }

    protected function updateSteps()
    {
        if (-1 === version_compare($this->getVersion(), self::VERSION)) {
            $this->setVersion(self::VERSION);

            return self::UPDATE_SUCCESS;
        }

        return self::UPDATE_NOTHING;
    }

    public function remove()
    {
        parent::remove();

        /**
         * National
         */
        $this->deleteConfiguration('SHIPPING_NATIONAL_START');
        $this->deleteConfiguration('SHIPPING_NATIONAL_COUNTRY');
        $this->deleteConfiguration('SHIPPING_NATIONAL_COSTS');
        $this->deleteConfiguration('SHIPPING_NATIONAL_END');
        /** */

        /**
         * International
         */
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_START');

        /** Premium */
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU');

        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG');

        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU');

        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG');

        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG');

        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG');

        /** Economy */
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU');

        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG');

        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU');

        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG');

        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG');

        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE');
        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG');

        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_END');
        /** */
    }

    public function quote()
    {
        global $shipping_weight;

        /**
         * Cost
         */
        $cost = 0;

        /** Base cost */
        $base_cost = self::_getConfig()->handling;

        if (is_numeric($base_cost)) {
            $cost += $base_cost;
        }

        /** Surcharge */
        $surcharges = explode(',', self::_getConfig()->cost);

        if (count($surcharges) > 0) {
            foreach ($surcharges as $surcharge) {
                $surcharge_cost_kg = explode(':', trim($surcharge));
                $surcharge_cost    = reset($surcharge_cost_kg);
                $surcharge_kg      = end($surcharge_cost_kg);

                if ($surcharge_kg < $shipping_weight) {
                    continue;
                }

                $cost += $surcharge_cost * $shipping_weight;
                break;
            }
        }

        /** Finish up */
        $quote = array(
            'id'      => $this->code,
            'module'  => sprintf(
                'DHL (%s kg)',
                round($shipping_weight, 2)
            ),
            'methods' => array(
                array(
                    'id'    => 'paket',
                    'title' => 'Paket Versand',
                    'cost'  => $cost,
                ),
                array(
                    'id'    => 'express',
                    'title' => 'Express Versand',
                    'cost'  => $cost * 2,
                ),
            ),
        );

        return $quote;
    }
}
