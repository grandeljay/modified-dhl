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
    public const VERSION = '0.2.1';
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
            sprintf('step="any" min="0.00"'),
            false,
            'number'
        );

        return $html;
    }

    public static function inputNumberRoundUp(string $value, string $option): string
    {
        $html  = '';
        $html .= xtc_draw_input_field(
            'configuration[' . $option . ']',
            $value,
            'step="0.01" min="0.00" max="0.99"',
            false,
            'number'
        );

        return $html;
    }
    /** */

    private static function groupStart(string $value, string $option): string
    {
        $config = self::_getConfig();

        ob_start();
        ?>
        <details class="<?= $config->screamingCaseToLispCase(substr($option, strlen(self::NAME) + 1)) ?>">
            <summary><?= $value ?></summary>
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
        return self::groupStart('<h2>' . $value . '</h2>', $option);
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
                                                <input type="number" step="any" min="0.00" name="weight" /> Kg
                                            </div>

                                            <div class="column">
                                                <input type="number" step="any" min="0.00" name="cost" /> EUR
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
                                                <input type="number" step="any" min="0.00" value="<?= $shipping_costs['weight'] ?>" name="weight" /> Kg
                                            </div>

                                            <div class="column">
                                                <input type="number" step="any" min="0.00" value="<?= $shipping_costs['cost'] ?>" name="cost" /> EUR
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
        return self::groupStart('<h2>' . $value . '</h2>', $option);
    }

    public static function internationalEndSet(string $value, string $option): string
    {
        return self::groupEnd($value, $option);
    }

    /** Premium */
    public static function internationalPremiumStartSet(string $value, string $option): string
    {
        return self::groupStart('<h3>' . $value . '</h3>', $option);
    }

    public static function internationalPremiumEndSet(string $value, string $option): string
    {
        return self::groupEnd($value, $option);
    }

    /** Economy */
    public static function internationalEconomyStartSet(string $value, string $option): string
    {
        return self::groupStart('<h3>' . $value . '</h3>', $option);
    }

    public static function internationalEconomyEndSet(string $value, string $option): string
    {
        return self::groupEnd($value, $option);
    }
    /** */

    /**
     * Surcharges
     */
    public static function surchargesStartSet(string $value, string $option): string
    {
        return self::groupStart('<h2>' . $value . '</h2>', $option);
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
                                                <input type="text" name="name" />
                                            </div>

                                            <div class="column">
                                                <input type="number" step="any" name="surcharge" />
                                            </div>

                                            <div class="column">
                                                <select name="type">
                                                    <option value="fixed"><?= self::_getConfig()->surchargesTypeFixed ?></option>
                                                    <option value="percent"><?= self::_getConfig()->surchargesTypePercent ?></option>
                                                </select>
                                            </div>

                                            <div class="column">
                                                <input type="date" name="duration-start" />
                                            </div>

                                            <div class="column">
                                                <input type="date" name="duration-end" />
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
                                                <input type="number" step="any" name="surcharge" value="<?= $surcharge['surcharge'] ?>" />
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
                                                <input type="date" name="duration-start" value="<?= $surcharge['duration-start'] ?? '' ?>" />
                                            </div>

                                            <div class="column">
                                                <input type="date" name="duration-end" value="<?= $surcharge['duration-end'] ?? '' ?>" />
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
        parent::__construct(self::NAME);

        $this->checkForUpdate(true);

        /**
         * Debug
         */
        $this->addKey('DEBUG_ENABLE');
        /** */

        /**
         * Maximum weight
         */
        $this->addKey('SHIPPING_MAX_WEIGHT');
        /** */

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
            $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_START');

                $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_ENABLE');

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

            $this->addKey('SHIPPING_INTERNATIONAL_PREMIUM_END');

            /** Economy */
            $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_START');

                $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_ENABLE');

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

            $this->addKey('SHIPPING_INTERNATIONAL_ECONOMY_END');

        $this->addKey('SHIPPING_INTERNATIONAL_END');
        /** */

        /**
         * Surcharges
         */
        $this->addKey('SURCHARGES_START');

        $this->addKey('SURCHARGES');

        $this->addKey('SURCHARGES_ROUND_UP');
        $this->addKey('SURCHARGES_ROUND_UP_TO');

        $this->addKey('SURCHARGES_END');
        /** */
    }

    public function install()
    {
        parent::install();

        $config = self::_getConfig();

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
         * Debug
         */
        $this->addConfigurationSelect('DEBUG_ENABLE', 'false', 6, 1);
        /** */

        /**
         * Maximum weight
         */
        $this->addConfiguration('SHIPPING_MAX_WEIGHT', SHIPPING_MAX_WEIGHT, 6, 1, self::class . '::inputNumber(');
        /** */

        /**
         * National
         */
        $this->addConfiguration('SHIPPING_NATIONAL_START', $config->shippingNationalStartTitle, 6, 1, self::class . '::nationalStartSet(');

        $this->addConfiguration('SHIPPING_NATIONAL_COUNTRY', STORE_COUNTRY, 6, 1, self::class . '::nationalCountrySet(');
        $this->addConfiguration('SHIPPING_NATIONAL_COSTS', $prices_national, 6, 1, self::class . '::nationalCostsSet(');

        $this->addConfiguration('SHIPPING_NATIONAL_END', '', 6, 1, self::class . '::nationalEndSet(');
        /** */

        /**
         * International
         */
        $this->addConfiguration('SHIPPING_INTERNATIONAL_START', $config->shippingInternationalStartTitle, 6, 1, self::class . '::internationalStartSet(');

            /** Premium */
            $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_START', $config->shippingInternationalPremiumStartTitle, 6, 1, self::class . '::internationalPremiumStartSet(');

                $this->addConfigurationSelect('SHIPPING_INTERNATIONAL_PREMIUM_ENABLE', 'true', 6, 1);

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

                $this->addConfiguration('SHIPPING_INTERNATIONAL_END', '', 6, 1, self::class . '::internationalPremiumEndSet(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_BASE', 24.45, 6, 1, self::class . '::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z4_PRICE_KG', 2.70, 6, 1, self::class . '::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_BASE', 26.30, 6, 1, self::class . '::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z5_PRICE_KG', 6.00, 6, 1, self::class . '::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_BASE', 35.90, 6, 1, self::class . '::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_Z6_PRICE_KG', 7.30, 6, 1, self::class . '::inputNumber(');

            $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_END', '', 6, 1, self::class . '::internationalPremiumEndSet(');

            /** Economy */
            $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_START', $config->shippingInternationalEconomyStartTitle, 6, 1, self::class . '::internationalEconomyStartSet(');

                $this->addConfigurationSelect('SHIPPING_INTERNATIONAL_ECONOMY_ENABLE', 'true', 6, 1);

                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_EU', 10.15, 6, 1, self::class . '::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_BASE_NONEU', 14.48, 6, 1, self::class . '::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_EU', 0.70, 6, 1, self::class . '::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z1_PRICE_KG_NONEU', 0.27, 6, 1, self::class . '::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_BASE', 10.70, 6, 1, self::class . '::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z2_PRICE_KG', 0.80, 6, 1, self::class . '::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_EU', 10.90, 6, 1, self::class . '::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_BASE_NONEU', 13.90, 6, 1, self::class . '::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_EU', 1.00, 6, 1, self::class . '::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z3_PRICE_KG_NONEU', 1.00, 6, 1, self::class . '::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_BASE', 23.80, 6, 1, self::class . '::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z4_PRICE_KG', 1.40, 6, 1, self::class . '::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_BASE', 26.30, 6, 1, self::class . '::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z5_PRICE_KG', 3.30, 6, 1, self::class . '::inputNumber(');

                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_BASE', 31.85, 6, 1, self::class . '::inputNumber(');
                $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_Z6_PRICE_KG', 3.20, 6, 1, self::class . '::inputNumber(');

            $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_END', '', 6, 1, self::class . '::internationalEconomyEndSet(');

        $this->addConfiguration('SHIPPING_INTERNATIONAL_END', '', 6, 1, self::class . '::internationalEndSet(');
        /** */

        /**
         * Surcharges
         */
        $this->addConfiguration('SURCHARGES_START', $config->surchargesStartTitle, 6, 1, self::class . '::surchargesStartSet(');

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
                    'duration-start' => date('Y') . '-10-31',
                    'duration-end'   => date('Y') + 1 . '-01-15',
                ),
                array(
                    'name'      => 'Pick & Pack',
                    'surcharge' => 10,
                    'type'      => 'percent',
                ),
            )
        );

        $this->addConfiguration('SURCHARGES', $surcharges, 6, 1, self::class . '::surchargesSet(');

        $this->addConfigurationSelect('SURCHARGES_ROUND_UP', 'true', 6, 1);
        $this->addConfiguration('SURCHARGES_ROUND_UP_TO', 0.90, 6, 1, self::class . '::inputNumberRoundUp(');

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
        $this->deleteConfiguration('ALLOWED');
        /** */

        /**
         * Debug
         */
        $this->deleteConfiguration('DEBUG_ENABLE');
        /** */

        /**
         * Maximum weight
         */
        $this->deleteConfiguration('SHIPPING_MAX_WEIGHT');
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
            $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_START');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_ENABLE', 'true', 6, 1);

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

            $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_END');

            /** Economy */
            $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_START');

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_ENABLE', 'true', 6, 1);

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

            $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_END');

        $this->deleteConfiguration('SHIPPING_INTERNATIONAL_END');
        /** */

        /**
         * Surcharges
         */
        $this->deleteConfiguration('SURCHARGES_START');

        $this->deleteConfiguration('SURCHARGES');

        $this->deleteConfiguration('SURCHARGES_ROUND_UP');
        $this->deleteConfiguration('SURCHARGES_ROUND_UP_TO');

        $this->deleteConfiguration('SURCHARGES_END');
        /** */
    }

    public function quote()
    {
        global $order, $shipping_weight, $shipping_num_boxes;

        require_once DIR_WS_CLASSES . 'grandeljaydhl_country.php';

        $country_delivery           = new grandeljaydhl_country($order->delivery['country']);
        $methods                    = array();
        $config                     = self::_getConfig();
        $shipping_weight_rounded_up = ceil($shipping_weight);

        /**
         * Maximum weight
         */
        foreach ($order->products as $product) {
            if ($product['weight'] >= $config->shippingMaxWeight) {
                return false;
            }
        }
        /** */

        /**
         * Shipping costs
         */

        /** National */
        $shipping_is_national = intval(STORE_COUNTRY) === $country_delivery->getCountryID();

        if ($shipping_is_national) {
            $method_paket_national = array(
                'id'    => 'paket-national',
                'title' => 'DHL Paket',
                'cost'  => 0,
                'debug' => array(
                    'calculations' => array(),
                ),
            );

            $shipping_national_costs = json_decode($config->shippingNationalCosts, true);

            asort($shipping_national_costs);

            foreach ($shipping_national_costs as $shipping_national_cost) {
                $max_weight                    = floatval($shipping_national_cost['weight']);
                $cost_for_weight               = floatval($shipping_national_cost['cost']);
                $method_paket_national['cost'] = $cost_for_weight;

                if ($shipping_weight < $max_weight) {
                    /** Debug mode */
                    $method_paket_national['debug']['calculations'][] = sprintf(
                        'Costs = National shipping (%01.2f €)',
                        $method_paket_national['cost'],
                        $method_paket_national['cost']
                    );
                    /** */

                    break;
                }
            }

            $methods[] = $method_paket_national;
        }

        /** International */
        $shipping_is_international = !$shipping_is_national;

        if ($shipping_is_international) {
            $zone = $country_delivery->getZone();

            /**
             * Premium
             */
            if ('true' === $config->shippingInternationalPremiumEnable) {
                $method_paket_international_premium = array(
                    'id'    => 'paket-international-premium',
                    'title' => 'DHL Paket (Premium)',
                    'cost'  => 0,
                    'debug' => array(
                        'calculations' => array(),
                    ),
                );

                /** Determine config keys for zone price */

                /** Base */
                $config_key_base       = 'shippingInternationalPremiumZ' . $zone . 'PriceBase';
                $config_key_base_eu    = 'shippingInternationalPremiumZ' . $zone . 'PriceBaseEu';
                $config_key_base_noneu = 'shippingInternationalPremiumZ' . $zone . 'PriceBaseNoneu';

                /** Kilogram */
                $config_key_kg       = 'shippingInternationalPremiumZ' . $zone . 'PriceKg';
                $config_key_kg_eu    = 'shippingInternationalPremiumZ' . $zone . 'PriceKgEu';
                $config_key_kg_noneu = 'shippingInternationalPremiumZ' . $zone . 'PriceKgNoneu';

                /** Add costs */
                $price_base = 0;
                $price_kg   = 0;

                if (isset($config->$config_key_base, $config->$config_key_kg)) {
                    $price_base = $config->$config_key_base;
                    $price_kg   = $config->$config_key_kg;
                } else {
                    if ($country_delivery->getIsEU()) {
                        if (isset($config->$config_key_base_eu, $config->$config_key_kg_eu)) {
                            $price_base = $config->$config_key_base_eu;
                            $price_kg   = $config->$config_key_kg_eu;
                        }
                    } else {
                        if (isset($config->$config_key_base_noneu, $config->$config_key_kg_noneu)) {
                            $price_base = $config->$config_key_base_noneu;
                            $price_kg   = $config->$config_key_kg_noneu;
                        }
                    }
                }

                $method_paket_international_premium['cost']                    = $price_base + $price_kg * $shipping_weight_rounded_up;
                $method_paket_international_premium['debug']['calculations'][] = sprintf(
                    'Costs = Base price for Zone %d (%01.2f €) + kg price (%01.2f €) * shipping weight (%01.2f kg) = %01.2f €',
                    $zone,
                    $price_base,
                    $price_kg,
                    $shipping_weight_rounded_up,
                    $method_paket_international_premium['cost']
                );

                $methods[] = $method_paket_international_premium;
            }

            /**
             * Economy
             */
            if ('true' === $config->shippingInternationalEconomyEnable) {
                $method_paket_international_economy = array(
                    'id'    => 'paket-international-economy',
                    'title' => 'DHL Paket (Economy)',
                    'cost'  => 0,
                    'debug' => array(
                        'calculations' => array(),
                    ),
                );

                /** Determine config keys for zone price */

                /** Base */
                $config_key_base       = 'shippingInternationalEconomyZ' . $zone . 'PriceBase';
                $config_key_base_eu    = 'shippingInternationalEconomyZ' . $zone . 'PriceBaseEu';
                $config_key_base_noneu = 'shippingInternationalEconomyZ' . $zone . 'PriceBaseNoneu';

                /** Kilogram */
                $config_key_kg       = 'shippingInternationalEconomyZ' . $zone . 'PriceKg';
                $config_key_kg_eu    = 'shippingInternationalEconomyZ' . $zone . 'PriceKgEu';
                $config_key_kg_noneu = 'shippingInternationalEconomyZ' . $zone . 'PriceKgNoneu';

                /** Add costs */
                $price_base = 0;
                $price_kg   = 0;

                if (isset($config->$config_key_base, $config->$config_key_kg)) {
                    $price_base = $config->$config_key_base;
                    $price_kg   = $config->$config_key_kg;
                } elseif (isset($config->$config_key_base_eu, $config->$config_key_base_noneu)) {
                    if ($country_delivery->getIsEU()) {
                        $price_base = $config->$config_key_base_eu;
                        $price_kg   = $config->$config_key_kg_eu;
                    } else {
                        $price_base = $config->$config_key_base_noneu;
                        $price_kg   = $config->$config_key_kg_noneu;
                    }
                }

                $method_paket_international_economy['cost']                    = $price_base + $price_kg * $shipping_weight_rounded_up;
                $method_paket_international_economy['debug']['calculations'][] = sprintf(
                    'Costs = Base price for Zone %d (%01.2f €) + kg price (%01.2f €) * shipping weight (%01.2f kg) = %01.2f €',
                    $zone,
                    $price_base,
                    $price_kg,
                    $shipping_weight_rounded_up,
                    $method_paket_international_economy['cost']
                );

                $methods[] = $method_paket_international_economy;
            }
        }

        /**
         * Surcharges
         */
        $surcharges_config = json_decode($config->surcharges, true);
        $surcharges        = array();
        $surcharges_update = false;

        foreach ($methods as &$method) {
            $cost_before_surcharges = $method['cost'];

            foreach ($surcharges_config as $surcharge) {
                if (!empty($surcharge['duration-start']) && !empty($surcharge['duration-end'])) {
                    /** Date now */
                    $date_now = new DateTime();

                    /** Duration start */
                    $duration_start           = new DateTime($surcharge['duration-start']);
                    $duration_start_is_active = $date_now >= $duration_start;

                    /** Duration end */
                    $duration_end           = new DateTime($surcharge['duration-end']);
                    $duration_end_is_active = $date_now <= $duration_end;

                    /** Automatically update duration years */
                    if ($date_now > $duration_start && $date_now > $duration_end) {
                        $new_duration_start = $duration_start->modify('+1 year');
                        $new_duration_end   = $duration_end->modify('+1 year');

                        $surcharge['duration-start'] = $new_duration_start->format('Y-m-d');
                        $surcharge['duration-end']   = $new_duration_end->format('Y-m-d');

                        $surcharges_update = true;
                    }

                    /** Duration now */
                    $duration_is_now = $duration_start_is_active && $duration_end_is_active;

                    if (!$duration_is_now) {
                        continue;
                    }
                }

                switch ($surcharge['type']) {
                    case 'fixed':
                        $surcharge_amount = $surcharge['surcharge'];
                        $method_cost      = $method['cost'];

                        $method['cost']                   += $surcharge_amount;
                        $method['debug']['calculations'][] = sprintf(
                            'Costs (%01.2f €) + %s (%01.2f €) = %01.2f €',
                            $method_cost,
                            $surcharge['name'],
                            $surcharge['surcharge'],
                            $method['cost']
                        );
                        break;

                    case 'percent':
                        $surcharge_amount = $cost_before_surcharges * ($surcharge['surcharge'] / 100);

                        $method['cost']                   += $surcharge_amount;
                        $method['debug']['calculations'][] = sprintf(
                            'Costs before surcharges (%01.2f €) * (%s: %d %% (%01.2f €)) = %01.2f €',
                            $cost_before_surcharges,
                            $surcharge['name'],
                            $surcharge['surcharge'],
                            $surcharge_amount,
                            $method['cost']
                        );
                        break;
                }
            }

            $surcharges[] = $surcharge;
        }

        /** Update surcharges option */
        if ($surcharges_update) {
            xtc_db_query(
                sprintf(
                    'UPDATE `%s`
                        SET `configuration_value` = "%s"
                      WHERE `configuration_key`   = "%s"',
                    TABLE_CONFIGURATION,
                    addslashes(json_encode($surcharges)),
                    'MODULE_SHIPPING_GRANDELJAYDHL_SURCHARGES'
                )
            );
        }

        /** Round up */
        if ('true' === $config->surchargesRoundUp && is_numeric($config->surchargesRoundUpTo)) {
            $config->surchargesRoundUpTo = (float) $config->surchargesRoundUpTo;

            foreach ($methods as &$method) {
                $method_cost     = $method['cost'];
                $number_whole    = floor($method_cost);
                $number_decimals = round($method_cost - $number_whole, 2);

                $round_up_to = $method_cost;

                if ($number_decimals > $config->surchargesRoundUpTo) {
                    $round_up_to = ceil($method_cost) + $config->surchargesRoundUpTo;
                }

                if ($number_decimals < $config->surchargesRoundUpTo) {
                    $round_up_to = $number_whole + $config->surchargesRoundUpTo;
                }

                $method['debug']['calculations'][] = sprintf(
                    'Costs (%01.2f €) round up to %01.2f = %01.2f',
                    $method_cost,
                    $config->surchargesRoundUpTo,
                    $round_up_to
                );

                $method['cost'] = $round_up_to;
            }
        }
        /** */

        /** Debug mode */
        if ('true' === $config->debugEnable) {
            foreach ($methods as &$method) {
                ob_start();
                ?>
                <br /><br />

                <h3>Debug mode</h3>

                <?php foreach ($method['debug']['calculations'] as $calculation) { ?>
                    <p><?= $calculation ?></p>
                <?php } ?>
                <?php
                $method['title'] .= ob_get_clean();
            }
        }
        /** */

        /**
         * Finish up
         */
        $quote = array(
            'id'      => $this->code,
            'module'  => sprintf(
                'DHL Paket (%01.1f kg)',
                $shipping_weight
            ),
            'methods' => $methods,
        );

        return $quote;
    }
}
