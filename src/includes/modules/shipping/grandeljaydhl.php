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

    private Configuration $config;

    public static function nationalCountrySet($countryID, $option): string
    {
        $country = xtc_db_fetch_array(
            xtc_db_query(
                'SELECT *
                   FROM `' . TABLE_COUNTRIES . '`
                  WHERE `countries_id` = ' . $countryID
            )
        );

        $html  = '';
        $html .= xtc_draw_input_field(
            'configuration[' . $option . ']',
            $country['countries_name'],
            'readonly="true"
             style="opacity: 0.4;"'
        );

        return $html;
    }

    public static function nationalCostsSet($value, $option): string
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
                                <div class="infoBoxHeadingTitle"><b><?= MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COSTS_TITLE ?></b></div>
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
                                                <b><?= MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_WEIGHT_TITLE ?></b><br>
                                                <?= MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_WEIGHT_DESC ?><br>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div>
                                            <b><?= MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COST_TITLE ?></b><br>
                                                <?= MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COST_DESC ?><br>
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
                                        <button name="grandeljaydhl_add"><?= MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_BUTTON_ADD ?></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="buttons">
                <button name="grandeljaydhl_apply" value="default"><?= MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_BUTTON_APPLY ?></button>
                <button name="grandeljaydhl_cancel" value="cancel"><?= MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_BUTTON_CANCEL ?></button>
            </div>
        </dialog>
        <?php
        $html .= ob_get_clean();

        return $html;
    }

    public function __construct()
    {
        $this->init(self::NAME);
        $this->checkForUpdate(true);
        $this->config = new Configuration(self::NAME);

        $this->addKey('SHIPPING_NATIONAL_COUNTRY');
        $this->addKey('SHIPPING_NATIONAL_COSTS');

        $this->addKey('ALLOWED');
        $this->addKey('HANDLING');
        $this->addKey('COST');
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

        $this->addConfiguration('SHIPPING_NATIONAL_COUNTRY', STORE_COUNTRY, 6, 1, 'grandeljaydhl::nationalCountrySet(');
        $this->addConfiguration('SHIPPING_NATIONAL_COSTS', $prices_national, 6, 1, 'grandeljaydhl::nationalCostsSet(');
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

        $this->deleteConfiguration('SHIPPING_NATIONAL_COUNTRY');
        $this->deleteConfiguration('SHIPPING_NATIONAL_COSTS');
    }

    public function quote()
    {
        global $shipping_weight;

        /**
         * Cost
         */
        $cost = 0;

        /** Base cost */
        $base_cost = $this->config->handling;

        if (is_numeric($base_cost)) {
            $cost += $base_cost;
        }

        /** Surcharge */
        $surcharges = explode(',', $this->config->cost);

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

        $quote = array(
            'id'      => $this->code,
            'module'  => sprintf(
                'DHL (%s kg)',
                round($shipping_weight, 2)
            ),
            'methods' => array(
                array(
                    'id'    => $this->code,
                    'title' => 'Versand via DHL',
                    'cost'  => $cost,
                ),
            ),
        );

        return $quote;
    }
}
