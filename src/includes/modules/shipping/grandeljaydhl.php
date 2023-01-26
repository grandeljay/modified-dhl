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
    /** */

    /**
     * Number type for option inputs
     */
    public static function inputNumber(string $value, string $option): string
    {
        $html  = '';
        $html .= xtc_draw_input_field(
            'configuration[' . $option . ']',
            $value,
            '',
            false,
            'number'
        );

        return $html;
    }
    /** */

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
                                                <input type="number" name="weight" /> Kg
                                            </div>

                                            <div class="column">
                                                <input type="number" name="cost" /> EUR
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

                                    foreach ($shipping_costs as $shipping_costs) {
                                        ?>
                                        <div class="row">
                                            <div class="column">
                                                <input type="number" value="<?= $shipping_costs['weight'] ?>" name="weight" /> Kg
                                            </div>

                                            <div class="column">
                                                <input type="number" value="<?= $shipping_costs['cost'] ?>" name="cost" /> EUR
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="row">
                                        <button name="grandeljaydhl_add" type="button"><?= self::_getConfig()->shippingNationalButtonAdd ?></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="buttons">
                <button name="grandeljaydhl_apply" value="default" type="button"><?= self::_getConfig()->shippingNationalButtonApply ?></button>
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
                                    <?php
                                    $regex_dd_mm = '^(01|02|03|04|05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|24|26|27|28|29|30|31)\.(01|02|03|04|05|06|07|08|09|10|11|12)\.$'
                                    ?>

                                    <template id="grandeljaydhl_row">
                                        <div class="row">
                                            <div class="column">
                                                <input type="text" name="name" />
                                            </div>

                                            <div class="column">
                                                <input type="number" name="surcharge" />
                                            </div>

                                            <div class="column">
                                                <select name="type">
                                                    <option value="fixed"><?= self::_getConfig()->surchargesTypeFixed ?></option>
                                                    <option value="percent"><?= self::_getConfig()->surchargesTypePercent ?></option>
                                                </select>
                                            </div>

                                            <div class="column">
                                                <input type="text" name="duration-start" pattern="<?= $regex_dd_mm ?>" />
                                            </div>

                                            <div class="column">
                                                <input type="text" name="duration-end" pattern="<?= $regex_dd_mm ?>" />
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

                                    <?php
                                    $surcharges = json_decode($value, true);
                                    ?>
                                    <?php foreach ($surcharges as $surcharge) { ?>
                                        <div class="row">
                                            <div class="column">
                                                <input type="text" name="name" value="<?= $surcharge['name'] ?>" />
                                            </div>

                                            <div class="column">
                                                <input type="number" name="surcharge" value="<?= $surcharge['surcharge'] ?>" />
                                            </div>

                                            <div class="column">
                                                <select name="type">
                                                    <?php
                                                    $fixedText   = self::_getConfig()->surchargesTypeFixed;
                                                    $percentText = self::_getConfig()->surchargesTypePercent;
                                                    $types       = array(
                                                        'fixed'   => $fixedText,
                                                        'percent' => $percentText,
                                                    );

                                                    foreach ($types as $type => $text) {
                                                        $selected = $type === $surcharge['type'] ? ' selected' : '';

                                                        echo '<option value="' . $type . '"' . $selected . '>' . $text . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="column">
                                                <input type="text" name="duration-start" pattern="<?= $regex_dd_mm ?>" value="<?= $surcharge['duration-start'] ?>" />
                                            </div>

                                            <div class="column">
                                                <input type="text" name="duration-end" pattern="<?= $regex_dd_mm ?>" value="<?= $surcharge['duration-end'] ?>" />
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="row">
                                        <button name="grandeljaydhl_add" type="button"><?= self::_getConfig()->shippingNationalButtonAdd ?></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="buttons">
                <button name="grandeljaydhl_apply" value="default" type="button"><?= self::_getConfig()->shippingNationalButtonApply ?></button>
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
                array(
                    'weight' => 20,
                    'cost'   => 4.06,
                ),
                array(
                    'weight' => 31.5,
                    'cost'   => 4.90,
                ),
            ),
        );

        /**
         * Required for modified compatibility
         */
        $this->addConfiguration('ALLOWED', '', 6, 1);
        /** */

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
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_EU', 10.44, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_BASE_NONEU', 19.40, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_EU', 0.64, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z1_PRICE_KG_NONEU', 1.00, 6, 1, self::class . '::inputNumber(');

        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_BASE', 10.76, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z2_PRICE_KG', 0.75, 6, 1, self::class . '::inputNumber(');

        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_EU', 10.97, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_BASE_NONEU', 17.79, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_EU', 0.85, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z3_PRICE_KG_NONEU', 1.81, 6, 1, self::class . '::inputNumber(');

        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE', 24.45, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG', 2.70, 6, 1, self::class . '::inputNumber(');

        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE', 26.30, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG', 6.00, 6, 1, self::class . '::inputNumber(');

        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE', 35.90, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG', 7.30, 6, 1, self::class . '::inputNumber(');

        /** Economy */
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU', 10.15, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU', 0.70, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU', 14.48, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU', 0.27, 6, 1, self::class . '::inputNumber(');

        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE', 10.70, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG', 0.80, 6, 1, self::class . '::inputNumber(');

        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU', 10.90, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU', 1.00, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU', 13.90, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU', 1.00, 6, 1, self::class . '::inputNumber(');

        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE', 23.80, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG', 1.40, 6, 1, self::class . '::inputNumber(');

        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE', 26.30, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG', 3.30, 6, 1, self::class . '::inputNumber(');

        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE', 31.85, 6, 1, self::class . '::inputNumber(');
        $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG', 3.20, 6, 1, self::class . '::inputNumber(');

        $this->addConfiguration('SHIPPING_INTERNATIONAL_END', '', 6, 1, self::class . '::internationalEndSet(');
        /** */

        /**
         * Surcharges
         */
        $this->addConfiguration('SURCHARGES_START', self::_getConfig()->surchargesStartTitle, 6, 1, self::class . '::surchargesStartSet(');

        $surcharges = json_encode(
            array(
                array(
                    'name'      => 'Energiezuschlag',
                    'surcharge' => 3.75,
                    'type'      => 'percent',
                ),
                array(
                    'name'      => 'Maut',
                    'surcharge' => 0.12,
                    'type'      => 'fixed',
                ),
                array(
                    'name'           => 'Peak',
                    'surcharge'      => 4.90,
                    'type'           => 'fixed',
                    'duration-start' => '31.10.',
                    'duration-end'   => '15.01.',
                ),
                array(
                    'name'      => 'Pick & Pack',
                    'surcharge' => 10,
                    'type'      => 'percent',
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
         * Required for modified compatibility
         */
        $this->deleteConfiguration('ALLOWED', '', 6, 1);
        /** */

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

        /**
         * Surcharges
         */
        $this->deleteConfiguration('SURCHARGES_START');
        $this->deleteConfiguration('SURCHARGES');
        $this->deleteConfiguration('SURCHARGES_END');
        /** */
    }

    public function quote()
    {
        global $order, $shipping_weight, $shipping_num_boxes;

        require_once DIR_WS_CLASSES . 'grandeljaydhl_country.php';

        $country_delivery = new grandeljaydhl_country($order->delivery['country']);

        $methods = array();

        /**
         * Shipping costs
         */

        /** National */
        $shipping_is_national = intval(STORE_COUNTRY) === $country_delivery->getZone();

        if ($shipping_is_national) {
            $method_national_paket = array(
                'id'    => 'national-paket',
                'title' => 'DHL Paket',
                'cost'  => 0,
            );

            $shipping_national_costs = json_decode(self::_getConfig()->shippingNationalCosts, true);

            asort($shipping_national_costs);

            $cost_to_add = 0;

            foreach ($shipping_national_costs as $shipping_national_cost) {
                $max_weight      = floatval($shipping_national_cost['weight']);
                $cost_for_weight = floatval($shipping_national_cost['cost']);
                $cost_to_add     = $cost_for_weight;

                if ($shipping_weight < $max_weight) {
                    break;
                }
            }

            $method_national_paket['cost'] += $cost_to_add;

            $methods[] = $method_national_paket;
        }

        /**
         * Surcharges
         */
        $surcharges = json_decode(self::_getConfig()->surcharges, true);

        foreach ($surcharges as $surcharge) {
            foreach ($methods as &$method) {
                $method_cost = $method['cost'];

                if (isset($surcharge['duration'], $surcharge['duration-start'], $surcharge['duration-end'])) {
                    $time            = time();
                    $duration_start  = strtotime($surcharge['duration-start'] . date('Y', $time));
                    $duration_end    = strtotime($surcharge['duration-end'] . date('Y', $time));
                    $duration_is_now = !($time > $duration_end && $time < $duration_start);

                    var_dump($duration_is_now);

                    if (!$duration_is_now) {
                        continue;
                    }
                }

                switch ($surcharge['type']) {
                    case 'fixed':
                        $method['cost'] += $surcharge['surcharge'];
                        break;

                    case 'percent':
                        $method['cost'] += $method_cost * ($surcharge['surcharge'] / 100);
                        break;
                }
            }
        }

        /** Finish up */
        $quote = array(
            'id'      => $this->code,
            'module'  => sprintf(
                'DHL Paket (%s kg)',
                round($shipping_weight, 2)
            ),
            'methods' => $methods,
        );

        return $quote;
    }
}
