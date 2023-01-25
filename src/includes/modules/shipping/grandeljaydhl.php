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
     * National settings
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
                <button name="grandeljaydhl_cancel" value="cancel"><?= self::_getConfig()->shippingNationalButtonCancel ?></button>
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

        $this->addKey('SHIPPING_NATIONAL_START');
        $this->addKey('SHIPPING_NATIONAL_COUNTRY');
        $this->addKey('SHIPPING_NATIONAL_COSTS');
        $this->addKey('SHIPPING_NATIONAL_END');

        $this->addKey('SHIPPING_INTERNATIONAL');
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

        $this->addConfiguration('SHIPPING_NATIONAL_START', self::_getConfig()->shippingNationalStartTitle, 6, 1, self::class . '::nationalStartSet(');
        $this->addConfiguration('SHIPPING_NATIONAL_COUNTRY', STORE_COUNTRY, 6, 1, self::class . '::nationalCountrySet(');
        $this->addConfiguration('SHIPPING_NATIONAL_COSTS', $prices_national, 6, 1, self::class . '::nationalCostsSet(');
        $this->addConfiguration('SHIPPING_NATIONAL_END', '', 6, 1, self::class . '::nationalEndSet(');
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

        $this->deleteConfiguration('SHIPPING_NATIONAL_START');
        $this->deleteConfiguration('SHIPPING_NATIONAL_COUNTRY');
        $this->deleteConfiguration('SHIPPING_NATIONAL_COSTS');
        $this->deleteConfiguration('SHIPPING_NATIONAL_END');
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
