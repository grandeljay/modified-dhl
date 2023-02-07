<?php

/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 *
 * @phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
 * @phpcs:disable Squiz.Classes.ValidClassName.NotCamelCaps
 */

use RobinTheHood\ModifiedStdModule\Classes\{StdModule, CaseConverter};

/**
 * Shipping methods musn't contain underscores.
 */
class grandeljaydhl extends StdModule
{
    public const VERSION = '0.3.0';
    public const NAME    = 'MODULE_SHIPPING_GRANDELJAYDHL';

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
        $key_without_module_name = substr($option, strlen(self::NAME) + 1);
        $key_lisp                = CaseConverter::screamingToLisp($key_without_module_name);

        ob_start();
        ?>
        <details class="<?= $key_lisp ?>">
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
     * Weight
     */
    public static function weightStartSet(string $value, string $option): string
    {
        return self::groupStart('<h2>' . $value . '</h2>', $option);
    }

    public static function weightEndSet(string $value, string $option): string
    {
        return self::groupEnd($value, $option);
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
            'readonly="readonly"
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
                                <div class="infoBoxHeadingTitle"><b><?= constant(self::NAME . '_SHIPPING_NATIONAL_COSTS_TITLE') ?></b></div>
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
                                                <b><?= constant(self::NAME . '_SHIPPING_NATIONAL_WEIGHT_TITLE') ?></b><br>
                                                <?= constant(self::NAME . '_SHIPPING_NATIONAL_WEIGHT_DESC') ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= constant(self::NAME . '_SHIPPING_NATIONAL_COST_TITLE') ?></b><br>
                                                <?= constant(self::NAME . '_SHIPPING_NATIONAL_COST_DESC') ?><br>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    $shipping_costs = json_decode($value, true);

                                    asort($shipping_costs);

                                    foreach ($shipping_costs as $shipping_cost) {
                                        ?>
                                        <div class="row">
                                            <div class="column">
                                                <input type="number" step="any" min="0.00" value="<?= $shipping_cost['weight'] ?>" name="weight" /> Kg
                                            </div>

                                            <div class="column">
                                                <input type="number" step="any" min="0.00" value="<?= $shipping_cost['cost'] ?>" name="cost" /> EUR
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <div class="row">
                                        <button name="grandeljaydhl_add" type="button"><?= constant(self::NAME . '_SHIPPING_NATIONAL_BUTTON_ADD') ?></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="buttons">
                <button name="grandeljaydhl_apply" value="default" type="button"><?= constant(self::NAME . '_SHIPPING_NATIONAL_BUTTON_APPLY') ?></button>
                <button name="grandeljaydhl_cancel" value="cancel" type="button"><?= constant(self::NAME . '_SHIPPING_NATIONAL_BUTTON_CANCEL') ?></button>
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
                                <div class="infoBoxHeadingTitle"><b><?= constant(self::NAME . '_SURCHARGES_TITLE') ?></b></div>
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
                                                    <option value="fixed"><?= constant(self::NAME . '_SURCHARGES_TYPE_FIXED') ?></option>
                                                    <option value="percent"><?= constant(self::NAME . '_SURCHARGES_TYPE_PERCENT') ?></option>
                                                </select>
                                            </div>

                                            <div class="column select-option">
                                                <label>
                                                    <?= xtc_cfg_select_option(array('true', 'false'), 'false') ?>
                                                </label>
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
                                                <b><?= constant(self::NAME . '_SURCHARGES_NAME_TITLE') ?></b><br>
                                                <?= constant(self::NAME . '_SURCHARGES_NAME_DESC') ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= constant(self::NAME . '_SURCHARGES_SURCHARGE_TITLE') ?></b><br>
                                                <?= constant(self::NAME . '_SURCHARGES_SURCHARGE_DESC') ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= constant(self::NAME . '_SURCHARGES_TYPE_TITLE') ?></b><br>
                                                <?= constant(self::NAME . '_SURCHARGES_TYPE_DESC') ?><br>
                                            </div>
                                        </div>

                                        <div class="column select-option">
                                            <div>
                                                <b><?= constant(self::NAME . '_SURCHARGES_PER_PACKAGE_TITLE') ?></b><br>
                                                <?= constant(self::NAME . '_SURCHARGES_PER_PACKAGE_DESC') ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= constant(self::NAME . '_SURCHARGES_DURATION_START_TITLE') ?></b><br>
                                                <?= constant(self::NAME . '_SURCHARGES_DURATION_START_DESC') ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= constant(self::NAME . '_SURCHARGES_DURATION_END_TITLE') ?></b><br>
                                                <?= constant(self::NAME . '_SURCHARGES_DURATION_END_DESC') ?><br>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    $surcharges = json_decode($value, true);
                                    ?>
                                    <?php foreach ($surcharges as $surcharge_index => $surcharge) { ?>
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
                                                    $fixedText   = constant(self::NAME . '_SURCHARGES_TYPE_FIXED');
                                                    $percentText = constant(self::NAME . '_SURCHARGES_TYPE_PERCENT');
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

                                            <div class="column select-option">
                                                <?php
                                                $key_write = sprintf('per-package-%d', $surcharge_index);
                                                $key_read  = sprintf('configuration[%s]', $key_write);
                                                ?>
                                                <label>
                                                    <?= xtc_cfg_select_option(array('true', 'false'), $surcharge[$key_read], $key_write) ?>
                                                </label>
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
                                        <button name="grandeljaydhl_add" type="button"><?= constant(self::NAME . '_SHIPPING_NATIONAL_BUTTON_ADD') ?></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="buttons">
                <button name="grandeljaydhl_apply" value="default" type="button"><?= constant(self::NAME . '_SHIPPING_NATIONAL_BUTTON_APPLY') ?></button>
                <button name="grandeljaydhl_cancel" value="cancel" type="button"><?= constant(self::NAME . '_SHIPPING_NATIONAL_BUTTON_CANCEL') ?></button>
            </div>
        </dialog>
        <?php
        $html .= ob_get_clean();

        return $html;
    }

    public static function surchargesPickAndPackSet(string $value, string $option): string
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
                                <div class="infoBoxHeadingTitle"><b><?= constant(self::NAME . '_SURCHARGES_PICK_AND_PACK_TITLE') ?></b></div>
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
                                                <b><?= constant(self::NAME . '_SHIPPING_NATIONAL_WEIGHT_TITLE') ?></b><br>
                                                <?= constant(self::NAME . '_SHIPPING_NATIONAL_WEIGHT_DESC') ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= constant(self::NAME . '_SHIPPING_NATIONAL_COST_TITLE') ?></b><br>
                                                <?= constant(self::NAME . '_SHIPPING_NATIONAL_COST_DESC') ?><br>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    $pick_and_pack_costs = json_decode($value, true);

                                    asort($pick_and_pack_costs);

                                    foreach ($pick_and_pack_costs as $pick_and_pack_cost) {
                                        ?>
                                        <div class="row">
                                            <div class="column">
                                                <input type="number" step="any" min="0.00" value="<?= $pick_and_pack_cost['weight'] ?>" name="weight" /> Kg
                                            </div>

                                            <div class="column">
                                                <input type="number" step="any" min="0.00" value="<?= $pick_and_pack_cost['cost'] ?>" name="cost" /> EUR
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <div class="row">
                                        <button name="grandeljaydhl_add" type="button"><?= constant(self::NAME . '_SHIPPING_NATIONAL_BUTTON_ADD') ?></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="buttons">
                <button name="grandeljaydhl_apply" value="default" type="button"><?= constant(self::NAME . '_SHIPPING_NATIONAL_BUTTON_APPLY') ?></button>
                <button name="grandeljaydhl_cancel" value="cancel" type="button"><?= constant(self::NAME . '_SHIPPING_NATIONAL_BUTTON_CANCEL') ?></button>
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
         * Weight
         */
        $this->addKey('SHIPPING_WEIGHT_START');

            $this->addKey('SHIPPING_WEIGHT_MAX');
            $this->addKey('SHIPPING_WEIGHT_IDEAL');

        $this->addKey('SHIPPING_WEIGHT_END');
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

            $this->addKey('SURCHARGES_PICK_AND_PACK');

            $this->addKey('SURCHARGES_ROUND_UP');
            $this->addKey('SURCHARGES_ROUND_UP_TO');

        $this->addKey('SURCHARGES_END');
        /** */
    }

    public function install()
    {
        parent::install();

        /**
         * Required for modified compatibility
         */
        $this->addConfiguration('ALLOWED', '', 6, 1);
        /** */

        /**
         * Debug
         */
        $this->addConfigurationSelect('DEBUG_ENABLE', 'true', 6, 1);
        /** */

        /**
         * Weight
         */
        $this->addConfiguration('SHIPPING_WEIGHT_START', $this->getConfig('SHIPPING_WEIGHT_START_TITLE'), 6, 1, self::class . '::weightStartSet(');

            $this->addConfiguration('SHIPPING_WEIGHT_MAX', 31.5, 6, 1, self::class . '::inputNumber(');
            $this->addConfiguration('SHIPPING_WEIGHT_IDEAL', 15, 6, 1, self::class . '::inputNumber(');

        $this->addConfiguration('SHIPPING_WEIGHT_END', '', 6, 1, self::class . '::weightEndSet(');
        /** */

        /**
         * National
         */
        $this->addConfiguration('SHIPPING_NATIONAL_START', $this->getConfig('SHIPPING_NATIONAL_START_TITLE'), 6, 1, self::class . '::nationalStartSet(');

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

            $this->addConfiguration('SHIPPING_NATIONAL_COUNTRY', STORE_COUNTRY, 6, 1, self::class . '::nationalCountrySet(');
            $this->addConfiguration('SHIPPING_NATIONAL_COSTS', $prices_national, 6, 1, self::class . '::nationalCostsSet(');

        $this->addConfiguration('SHIPPING_NATIONAL_END', '', 6, 1, self::class . '::nationalEndSet(');
        /** */

        /**
         * International
         */
        $this->addConfiguration('SHIPPING_INTERNATIONAL_START', $this->getConfig('SHIPPING_INTERNATIONAL_START_TITLE'), 6, 1, self::class . '::internationalStartSet(');

            /** Premium */
            $this->addConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_START', $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_START_TITLE'), 6, 1, self::class . '::internationalPremiumStartSet(');

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
            $this->addConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_START', $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_START_TITLE'), 6, 1, self::class . '::internationalEconomyStartSet(');

                $this->addConfigurationSelect('SHIPPING_INTERNATIONAL_ECONOMY_ENABLE', 'false', 6, 1);

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
        $this->addConfiguration('SURCHARGES_START', $this->getConfig('SURCHARGES_START_TITLE'), 6, 1, self::class . '::surchargesStartSet(');

            $surcharges = json_encode(
                array(
                    array(
                        'name'                         => 'Energiezuschlag',
                        'surcharge'                    => 3.75,
                        'type'                         => 'percent',
                        'configuration[per-package-0]' => 'false',
                    ),
                    array(
                        'name'                         => 'Maut',
                        'surcharge'                    => 0.12,
                        'type'                         => 'fixed',
                        'configuration[per-package-1]' => 'true',
                    ),
                    array(
                        'name'                         => 'Peak',
                        'surcharge'                    => 4.90,
                        'type'                         => 'fixed',
                        'configuration[per-package-2]' => 'false',
                        'duration-start'               => date('Y') . '-10-31',
                        'duration-end'                 => date('Y') + 1 . '-01-15',
                    ),
                )
            );

            $this->addConfiguration('SURCHARGES', $surcharges, 6, 1, self::class . '::surchargesSet(');

            $pick_and_pack = json_encode(
                array(
                    array(
                        'weight' => 1.00,
                        'cost'   => 1.30,
                    ),
                    array(
                        'weight' => 5.00,
                        'cost'   => 1.60,
                    ),
                    array(
                        'weight' => 10.00,
                        'cost'   =>  2.00,
                    ),
                    array(
                        'weight' => 20.00,
                        'cost'   =>  2.60,
                    ),
                    array(
                        'weight' => 60.00,
                        'cost'   =>  3.00,
                    ),
                ),
            );

            $this->addConfiguration('SURCHARGES_PICK_AND_PACK', $pick_and_pack, 6, 1, self::class . '::surchargesPickAndPackSet(');

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
         * Weight
         */
        $this->deleteConfiguration('SHIPPING_WEIGHT_START');
        $this->deleteConfiguration('SHIPPING_WEIGHT_MAX');
        $this->deleteConfiguration('SHIPPING_WEIGHT_IDEAL');
        $this->deleteConfiguration('SHIPPING_WEIGHT_END');
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

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_PREMIUM_ENABLE');

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

                $this->deleteConfiguration('SHIPPING_INTERNATIONAL_ECONOMY_ENABLE');

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

            $this->deleteConfiguration('SURCHARGES_PICK_AND_PACK');

            $this->deleteConfiguration('SURCHARGES_ROUND_UP');
            $this->deleteConfiguration('SURCHARGES_ROUND_UP_TO');

        $this->deleteConfiguration('SURCHARGES_END');
        /** */
    }

    public function quote()
    {
        global $order;

        require_once DIR_WS_CLASSES . 'grandeljaydhl_country.php';
        require_once DIR_WS_CLASSES . 'grandeljaydhl_parcel.php';

        $country_delivery = new grandeljaydhl_country($order->delivery['country']);
        $methods          = array();

        /**
         * Weight
         */
        /** Maximum */
        foreach ($order->products as $product) {
            if ($product['weight'] >= $this->getConfig('SHIPPING_WEIGHT_MAX')) {
                return false;
            }
        }
        /** */

        /**
         * Amount of boxes
         */
        $boxes                   = array();
        $box                     = new grandeljaydhl_parcel();
        $grandeljay_total_weight = 0;

        foreach ($order->products as $product) {
            for ($i = 1; $i <= $product['quantity']; $i++) {
                /** Create a new box */
                $box_weight     = $box->getWeight();
                $product_weight = $product['weight'];

                if ($box_weight + $product_weight > $this->getConfig('SHIPPING_WEIGHT_IDEAL')) {
                    $boxes[] = $box;
                    $box     = new grandeljaydhl_parcel();
                }

                $box->addProduct($product);

                $grandeljay_total_weight += $product_weight;
            }
        }

        $boxes[] = $box;
        $box     = new grandeljaydhl_parcel();
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

            $shipping_national_costs = json_decode($this->getConfig('SHIPPING_NATIONAL_COSTS'), true);

            asort($shipping_national_costs);

            foreach ($boxes as $box_index => $box) {
                foreach ($shipping_national_costs as $shipping_national_cost) {
                    $weight_max  = floatval($shipping_national_cost['weight']);
                    $weight_cost = floatval($shipping_national_cost['cost']);

                    if ($box['weight'] <= $weight_max) {
                        $costs_before = $method_paket_national['cost'];

                        $method_paket_national['cost']                   += $weight_cost;
                        $method_paket_national['debug']['calculations'][] = sprintf(
                            'Costs (%01.2f €) + National shipping (%01.2f €) for box %d / %d (%01.2f kg) = %01.2f €',
                            $costs_before,
                            $weight_cost,
                            $box_index + 1,
                            count($boxes),
                            $box['weight'],
                            $method_paket_national['cost']
                        );

                        break;
                    }
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
            if ('true' === $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_ENABLE')) {
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
                $config_base       = $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_Z' . $zone . '_PRICE_BASE', false);
                $config_base_eu    = $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_Z' . $zone . '_PRICE_BASE_EU', false);
                $config_base_noneu = $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_Z' . $zone . '_PRICE_BASE_NONEU', false);

                /** Kilogram */
                $config_kg       = $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_Z' . $zone . '_PRICE_KG', false);
                $config_kg_eu    = $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_Z' . $zone . '_PRICE_KG_EU', false);
                $config_kg_noneu = $this->getConfig('SHIPPING_INTERNATIONAL_PREMIUM_Z' . $zone . '_PRICE_KG_NONEU', false);

                /** Add costs */
                $price_base = 0;
                $price_kg   = 0;

                if (!in_array(false, array($config_base, $config_kg), true)) {
                    $price_base = $config_base;
                    $price_kg   = $config_kg;
                } else {
                    if ($country_delivery->getIsEU()) {
                        if (!in_array(false, array($config_base_eu, $config_kg_eu), true)) {
                            $price_base = $config_base_eu;
                            $price_kg   = $config_kg_eu;
                        }
                    } else {
                        if (!in_array(false, array($config_base_noneu, $config_kg_noneu), true)) {
                            $price_base = $config_base_noneu;
                            $price_kg   = $config_kg_noneu;
                        }
                    }
                }

                foreach ($boxes as $box_index => $box) {
                    $costs_before = $method_paket_international_premium['cost'];

                    $method_paket_international_premium['cost']                   += $price_base + $price_kg * ceil($box['weight']);
                    $method_paket_international_premium['debug']['calculations'][] = sprintf(
                        'Costs (%01.2f €) + Base price for Zone %d (%01.2f €) + kg price (%01.2f €) for box %d / %d (%01.2f kg) = %01.2f €',
                        $costs_before,
                        $zone,
                        $price_base,
                        $price_kg,
                        $box_index + 1,
                        count($boxes),
                        $box['weight'],
                        $method_paket_international_premium['cost']
                    );
                }

                $methods[] = $method_paket_international_premium;
            }

            /**
             * Economy
             */
            if ('true' === $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_ENABLE')) {
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
                $config_base       = $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_Z' . $zone . '_PRICE_BASE', false);
                $config_base_eu    = $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_Z' . $zone . '_PRICE_BASE_EU', false);
                $config_base_noneu = $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_Z' . $zone . '_PRICE_BASE_NONEU', false);

                /** Kilogram */
                $config_kg       = $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_Z' . $zone . '_PRICE_KG', false);
                $config_kg_eu    = $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_Z' . $zone . '_PRICE_KG_EU', false);
                $config_kg_noneu = $this->getConfig('SHIPPING_INTERNATIONAL_ECONOMY_Z' . $zone . '_PRICE_KG_NONEU', false);

                /** Add costs */
                $price_base = 0;
                $price_kg   = 0;

                if (!in_array(false, array($config_base, $config_kg), true)) {
                    $price_base = $config_base;
                    $price_kg   = $config_kg;
                } elseif ($country_delivery->getIsEU()) {
                    if (!in_array(false, array($config_base_eu, $config_kg_eu), true)) {
                        $price_base = $config_base_eu;
                        $price_kg   = $config_kg_eu;
                    }
                } else {
                    if (!in_array(false, array($config_base_noneu, $config_kg_noneu), true)) {
                        $price_base = $config_base_noneu;
                        $price_kg   = $config_kg_noneu;
                    }
                }

                foreach ($boxes as $box_index => $box) {
                    $costs_before = $method_paket_international_economy['cost'];

                    $method_paket_international_economy['cost']                   += $price_base + $price_kg * ceil($box['weight']);
                    $method_paket_international_economy['debug']['calculations'][] = sprintf(
                        'Costs (%01.2f €) + Base price for Zone %d (%01.2f €) + kg price (%01.2f €) for box %d / %d (%01.2f kg) = %01.2f €',
                        $costs_before,
                        $zone,
                        $price_base,
                        $price_kg,
                        $box_index + 1,
                        count($boxes),
                        $box['weight'],
                        $method_paket_international_economy['cost']
                    );
                }

                $methods[] = $method_paket_international_economy;
            }
        }

        /**
         * Surcharges
         */
        $surcharges_config = json_decode($this->getConfig('SURCHARGES'), true);
        $surcharges        = array();
        $surcharges_update = false;

        foreach ($methods as &$method) {
            $cost_before_surcharges = $method['cost'];

            foreach ($surcharges_config as $surcharge_index => $surcharge) {
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

                $key_per_package = sprintf('configuration[per-package-%d]', $surcharge_index);

                switch ($surcharge['type']) {
                    case 'fixed':
                        $surcharge_amount = $surcharge['surcharge'];

                        foreach ($boxes as $box_index => $box) {
                            $method_cost                       = $method['cost'];
                            $method['cost']                   += $surcharge_amount;
                            $method['debug']['calculations'][] = sprintf(
                                'Costs (%01.2f €) + %s (%01.2f €) for box %d / %d (%01.2f kg) = %01.2f €',
                                $method_cost,
                                $surcharge['name'],
                                $surcharge['surcharge'],
                                $box_index + 1,
                                count($boxes),
                                $box['weight'],
                                $method['cost']
                            );

                            if ('true' !== $surcharge[$key_per_package]) {
                                break;
                            }
                        }
                        break;

                    case 'percent':
                        $surcharge_amount = $cost_before_surcharges * ($surcharge['surcharge'] / 100);

                        foreach ($boxes as $box_index => $box) {
                            $method['cost']                   += $surcharge_amount;
                            $method['debug']['calculations'][] = sprintf(
                                'Costs before surcharges (%01.2f €) * (%s: %01.2f %% (%01.2f €)) = %01.2f €',
                                $cost_before_surcharges,
                                $surcharge['name'],
                                $surcharge['surcharge'],
                                $surcharge_amount,
                                $method['cost']
                            );

                            if ('true' !== $surcharge[$key_per_package]) {
                                break;
                            }
                        }
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

        /** Pick and Pack */
        foreach ($methods as &$method) {
            $pick_and_pack_costs = json_decode($this->getConfig('SURCHARGES_PICK_AND_PACK', '[]'), true);

            asort($pick_and_pack_costs);

            foreach ($boxes as $box_index => $box) {
                foreach ($pick_and_pack_costs as $pick_and_pack_cost) {
                    $weight_max  = floatval($pick_and_pack_cost['weight']);
                    $weight_cost = floatval($pick_and_pack_cost['cost']);

                    if ($box['weight'] <= $weight_max) {
                        $cost_before = $method['cost'];

                        $method['cost']                   += $weight_cost;
                        $method['debug']['calculations'][] = sprintf(
                            'Costs (%01.2f €) + Pick and Pack (%01.2f €) for box %d / %d (%01.2f kg) = %01.2f €',
                            $cost_before,
                            $weight_cost,
                            $box_index + 1,
                            count($boxes),
                            $box['weight'],
                            $method['cost']
                        );

                        break;
                    }
                }
            }
        }

        /** Round up */
        $surcharges_round_up_to = $this->getConfig('SURCHARGES_ROUND_UP');

        if ('true' === $surcharges_round_up_to && is_numeric($surcharges_round_up_to)) {
            $surcharges_round_up_to = (float) $surcharges_round_up_to;

            foreach ($methods as &$method) {
                $method_cost     = $method['cost'];
                $number_whole    = floor($method_cost);
                $number_decimals = round($method_cost - $number_whole, 2);

                $round_up_to = $method_cost;

                if ($number_decimals > $surcharges_round_up_to) {
                    $round_up_to = ceil($method_cost) + $surcharges_round_up_to;
                }

                if ($number_decimals < $surcharges_round_up_to) {
                    $round_up_to = $number_whole + $surcharges_round_up_to;
                }

                $method['debug']['calculations'][] = sprintf(
                    'Costs (%01.2f €) round up to %01.2f = %01.2f',
                    $method_cost,
                    $surcharges_round_up_to,
                    $round_up_to
                );

                $method['cost'] = $round_up_to;
            }
        }
        /** */

        /** Debug mode */
        $debug_is_enabled = $this->getConfig('DEBUG_ENABLE');
        $user_is_admin    = isset($_SESSION['customers_status']['customers_status_id']) && 0 === (int) $_SESSION['customers_status']['customers_status_id'];

        if ('true' === $debug_is_enabled && $user_is_admin) {
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

        /** Weight string */
        $boxes_weight = array();

        foreach ($boxes as $box) {
            $key = $box['weight'] . ' kg';

            if (isset($boxes_weight[$key])) {
                $boxes_weight[$key]++;
            } else {
                $boxes_weight[$key] = 1;
            }
        }

        $boxes_weight_unique = array_unique($boxes_weight);

        arsort($boxes_weight_unique);

        $boxes_weight_text = array();

        foreach ($boxes_weight_unique as $weight_text => $quantity) {
            preg_match('/[\d+\.]+/', $weight_text, $weight_matches);

            $weight = round($weight_matches[0], 2) . ' kg';

            $boxes_weight_text[] = sprintf(
                '%dx %s',
                $quantity,
                $weight
            );
        }

        if ('true' !== $debug_is_enabled || !$user_is_admin) {
            $boxes_weight_text = array(
                sprintf(
                    '%s kg',
                    round($grandeljay_total_weight, 2)
                ),
            );
        }

        /** Quote */
        $quote = array(
            'id'      => $this->code,
            'module'  => sprintf(
                'DHL Paket (%s)',
                implode(', ', $boxes_weight_text)
            ),
            'methods' => $methods,
        );

        return $quote;
    }
}
