<?php

namespace Grandeljay\Dhl\Configuration;

class Field
{
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

    /**
     * National
     */
    public static function shippingNationalCountry(string $countryID, string $option): string
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

    public static function shippingNationalCosts(string $value, string $option): string
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
                                <div class="infoBoxHeadingTitle"><b><?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_COSTS_TITLE') ?></b></div>
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
                                                <b><?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_WEIGHT_TITLE') ?></b><br>
                                                <?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_WEIGHT_DESC') ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_COST_TITLE') ?></b><br>
                                                <?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_COST_DESC') ?><br>
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
                                        <button name="grandeljaydhl_add" type="button"><?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_BUTTON_ADD') ?></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="buttons">
                <button name="grandeljaydhl_apply" value="default" type="button"><?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_BUTTON_APPLY') ?></button>
                <button name="grandeljaydhl_cancel" value="cancel" type="button"><?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_BUTTON_CANCEL') ?></button>
            </div>
        </dialog>
        <?php
        $html .= ob_get_clean();

        return $html;
    }

    /**
     * Surcharges
     */
    public static function surcharges(string $value, string $option): string
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
                                <div class="infoBoxHeadingTitle"><b><?= constant(\grandeljaydhl::NAME . '_SURCHARGES_TITLE') ?></b></div>
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
                                                    <option value="fixed"><?= constant(\grandeljaydhl::NAME . '_SURCHARGES_TYPE_FIXED') ?></option>
                                                    <option value="percent"><?= constant(\grandeljaydhl::NAME . '_SURCHARGES_TYPE_PERCENT') ?></option>
                                                </select>
                                            </div>

                                            <div class="column select-option">
                                                <label>
                                                    <?= xtc_cfg_select_option(['true', 'false'], 'false') ?>
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
                                                <b><?= constant(\grandeljaydhl::NAME . '_SURCHARGES_NAME_TITLE') ?></b><br>
                                                <?= constant(\grandeljaydhl::NAME . '_SURCHARGES_NAME_DESC') ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= constant(\grandeljaydhl::NAME . '_SURCHARGES_SURCHARGE_TITLE') ?></b><br>
                                                <?= constant(\grandeljaydhl::NAME . '_SURCHARGES_SURCHARGE_DESC') ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= constant(\grandeljaydhl::NAME . '_SURCHARGES_TYPE_TITLE') ?></b><br>
                                                <?= constant(\grandeljaydhl::NAME . '_SURCHARGES_TYPE_DESC') ?><br>
                                            </div>
                                        </div>

                                        <div class="column select-option">
                                            <div>
                                                <b><?= constant(\grandeljaydhl::NAME . '_SURCHARGES_PER_PACKAGE_TITLE') ?></b><br>
                                                <?= constant(\grandeljaydhl::NAME . '_SURCHARGES_PER_PACKAGE_DESC') ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= constant(\grandeljaydhl::NAME . '_SURCHARGES_DURATION_START_TITLE') ?></b><br>
                                                <?= constant(\grandeljaydhl::NAME . '_SURCHARGES_DURATION_START_DESC') ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= constant(\grandeljaydhl::NAME . '_SURCHARGES_DURATION_END_TITLE') ?></b><br>
                                                <?= constant(\grandeljaydhl::NAME . '_SURCHARGES_DURATION_END_DESC') ?><br>
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
                                                    $fixedText   = constant(\grandeljaydhl::NAME . '_SURCHARGES_TYPE_FIXED');
                                                    $percentText = constant(\grandeljaydhl::NAME . '_SURCHARGES_TYPE_PERCENT');
                                                    $types       = [
                                                        'fixed'   => $fixedText,
                                                        'percent' => $percentText,
                                                    ];

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
                                                    <?= xtc_cfg_select_option(['true', 'false'], $surcharge[$key_read], $key_write) ?>
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
                                        <button name="grandeljaydhl_add" type="button"><?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_BUTTON_ADD') ?></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="buttons">
                <button name="grandeljaydhl_apply" value="default" type="button"><?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_BUTTON_APPLY') ?></button>
                <button name="grandeljaydhl_cancel" value="cancel" type="button"><?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_BUTTON_CANCEL') ?></button>
            </div>
        </dialog>
        <?php
        $html .= ob_get_clean();

        return $html;
    }

    public static function surchargesPickAndPack(string $value, string $option): string
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
                                <div class="infoBoxHeadingTitle"><b><?= constant(\grandeljaydhl::NAME . '_SURCHARGES_PICK_AND_PACK_TITLE') ?></b></div>
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
                                                <b><?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_WEIGHT_TITLE') ?></b><br>
                                                <?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_WEIGHT_DESC') ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                                <b><?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_COST_TITLE') ?></b><br>
                                                <?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_COST_DESC') ?><br>
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
                                        <button name="grandeljaydhl_add" type="button"><?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_BUTTON_ADD') ?></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="buttons">
                <button name="grandeljaydhl_apply" value="default" type="button"><?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_BUTTON_APPLY') ?></button>
                <button name="grandeljaydhl_cancel" value="cancel" type="button"><?= constant(\grandeljaydhl::NAME . '_SHIPPING_NATIONAL_BUTTON_CANCEL') ?></button>
            </div>
        </dialog>
        <?php
        $html .= ob_get_clean();

        return $html;
    }
}
