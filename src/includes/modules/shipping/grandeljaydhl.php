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

use Grandeljay\Dhl\{Country, Parcel, Quote};
use Grandeljay\Dhl\Configuration\Group;
use RobinTheHood\ModifiedStdModule\Classes\CaseConverter;
use RobinTheHood\ModifiedStdModule\Classes\StdModule;

/**
 * Shipping methods musn't contain underscores.
 */
class grandeljaydhl extends StdModule
{
    public const NAME    = 'MODULE_SHIPPING_GRANDELJAYDHL';
    public const VERSION = '0.11.2';

    public static function setFunction(string $value, string $option): string
    {
        $namespace_configuration = '\\Grandeljay\\Dhl\\Configuration';

        $key_without_module_name = substr(
            $option,
            strlen(self::NAME) + 1,
        );
        $method_name             = CaseConverter::screamingToCamel($key_without_module_name);

        $key_start = substr($key_without_module_name, -5);
        $key_end   = substr($key_without_module_name, -3);
        $is_group  = 'START' === $key_start || 'END' === $key_end;

        if ($is_group) {
            $namespace_configuration .= '\\Group';
        } else {
            $namespace_configuration .= '\\Field';
        }

        if (!method_exists($namespace_configuration, $method_name) && is_numeric($value)) {
            $method_name = 'inputNumber';
        }

        return call_user_func(
            $namespace_configuration . '::' . $method_name,
            $value,
            $option
        );
    }

    /**
     * Used by modified to determine the cheapest shipping method. Should
     * contain the return value of the `quote` method.
     *
     * @var array
     */
    public array $quotes = [];

    /**
     * Used to calculate the tax.
     *
     * @var int
     */
    public int $tax_class = 1;

    public function __construct()
    {
        parent::__construct(self::NAME);

        $this->checkForUpdate(true);
        $this->addKeys();
    }

    private function addKeys(): void
    {
        /**
         * Sort Order
         */
        $this->addKey('SORT_ORDER');

        /**
         * Debug
         */
        $this->addKey('DEBUG_ENABLE');
        /** */

        $this->addKeysWeight();
        $this->addKeysShippingNational();
        $this->addKeysShippingInternational();
        $this->addKeysSurcharges();
    }

    private function addKeysWeight(): void
    {
        $this->addKey(Group::SHIPPING_WEIGHT . '_START');
        $this->addKey(Group::SHIPPING_WEIGHT . '_MAX');
        $this->addKey(Group::SHIPPING_WEIGHT . '_IDEAL');
        $this->addKey(Group::SHIPPING_WEIGHT . '_END');
    }

    private function addKeysShippingNational(): void
    {
        $this->addKey(Group::SHIPPING_NATIONAL . '_START');
        $this->addKey(Group::SHIPPING_NATIONAL . '_COUNTRY');
        $this->addKey(Group::SHIPPING_NATIONAL . '_COSTS');
        $this->addKey(Group::SHIPPING_NATIONAL . '_END');
    }

    private function addKeysShippingInternational(): void
    {
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_START');
        $this->addKeysShippingInternationalPremium();
        $this->addKeysShippingInternationalEconomy();
        $this->addKEysShippingInternationalExceptions();
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_END');
    }

    private function addKeysShippingInternationalPremium(): void
    {
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_START');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_ENABLE');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_EU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_NONEU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_EU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_NONEU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_BASE');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_KG');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_EU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_NONEU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_EU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_NONEU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_BASE');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_KG');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_BASE');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_KG');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_BASE');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_KG');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_END');
    }

    private function addKeysShippingInternationalEconomy(): void
    {
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_START');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_ENABLE');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_EU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_NONEU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_EU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_NONEU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_BASE');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_KG');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_EU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_NONEU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_EU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_NONEU');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_BASE');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_KG');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_BASE');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_KG');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_BASE');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_KG');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_END');
    }

    private function addKeysShippingInternationalExceptions(): void
    {
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_START');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_DATA');
        $this->addKey(Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_END');
    }

    private function addKeysSurcharges(): void
    {
        $this->addKey(Group::SURCHARGES . '_START');
        $this->addKey('SURCHARGES');
        $this->addKey(Group::SURCHARGES . '_PICK_AND_PACK');
        $this->addKey(Group::SURCHARGES . '_ROUND_UP');
        $this->addKey(Group::SURCHARGES . '_ROUND_UP_TO');
        $this->addKey(Group::SURCHARGES . '_END');
    }

    public function install()
    {
        parent::install();

        $this->addConfigurations();
    }

    private function addConfigurations(): void
    {
        /**
         * Required for modified compatibility
         */
        $this->addConfiguration('ALLOWED', '', 6, 1);
        /** */

        /**
         * Sort Order
         */
        $this->addConfiguration('SORT_ORDER', 1, 6, 1);

        /**
         * Debug
         */
        $this->addConfigurationSelect('DEBUG_ENABLE', 'true', 6, 1);
        /** */

        $this->addConfigurationWeight();
        $this->addConfigurationShippingNational();
        $this->addConfigurationShippingInternational();
        $this->addConfigurationSurcharges();
    }

    private function addConfigurationWeight(): void
    {
        $this->addConfiguration(Group::SHIPPING_WEIGHT . '_START', $this->getConfig(Group::SHIPPING_WEIGHT . '_START_TITLE'), 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_WEIGHT . '_MAX', 31.5, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_WEIGHT . '_IDEAL', 15, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_WEIGHT . '_END', '', 6, 1, self::class . '::setFunction(');
    }

    private function addConfigurationShippingNational(): void
    {
        $this->addConfiguration(Group::SHIPPING_NATIONAL . '_START', $this->getConfig(Group::SHIPPING_NATIONAL . '_START_TITLE'), 6, 1, self::class . '::setFunction(');

        $prices_national = json_encode(
            [
                [
                    'weight' => 20,
                    'cost'   => 4.06,
                ],
                [
                    'weight' => 31.5,
                    'cost'   => 4.90,
                ],
            ],
        );

        $this->addConfiguration(Group::SHIPPING_NATIONAL . '_COUNTRY', \STORE_COUNTRY, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_NATIONAL . '_COSTS', $prices_national, 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SHIPPING_NATIONAL . '_END', '', 6, 1, self::class . '::setFunction(');
    }

    private function addConfigurationShippingInternational(): void
    {
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_START', $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_START_TITLE'), 6, 1, self::class . '::setFunction(');

        $this->addConfigurationShippingInternationalPremium();
        $this->addConfigurationShippingInternationalEconomy();
        $this->addConfigurationShippingInternationalExceptions();

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_END', '', 6, 1, self::class . '::setFunction(');
    }

    private function addConfigurationShippingInternationalPremium(): void
    {
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_START', $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_START_TITLE'), 6, 1, self::class . '::setFunction(');

        $this->addConfigurationSelect(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_ENABLE', 'true', 6, 1);

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_EU', 10.44, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_NONEU', 19.40, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_EU', 0.64, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_NONEU', 1.00, 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_BASE', 10.76, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_KG', 0.75, 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_EU', 10.97, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_NONEU', 17.79, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_EU', 0.85, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_NONEU', 1.81, 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_BASE', 24.45, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_KG', 2.70, 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_BASE', 26.30, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_KG', 6.00, 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_BASE', 35.90, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_KG', 7.30, 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_END', '', 6, 1, self::class . '::setFunction(');
    }

    private function addConfigurationShippingInternationalEconomy(): void
    {
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_START', $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_START_TITLE'), 6, 1, self::class . '::setFunction(');

        $this->addConfigurationSelect(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_ENABLE', 'false', 6, 1);

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_EU', 10.15, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_NONEU', 14.48, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_EU', 0.70, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_NONEU', 0.27, 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_BASE', 10.70, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_KG', 0.80, 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_EU', 10.90, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_NONEU', 13.90, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_EU', 1.00, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_NONEU', 1.00, 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_BASE', 23.80, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_KG', 1.40, 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_BASE', 26.30, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_KG', 3.30, 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_BASE', 31.85, 6, 1, self::class . '::setFunction(');
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_KG', 3.20, 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_END', '', 6, 1, self::class . '::setFunction(');
    }

    private function addConfigurationShippingInternationalExceptions(): void
    {
        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_START', $this->getConfig(Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_START_TITLE'), 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_DATA', '', 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_END', '', 6, 1, self::class . '::setFunction(');
    }

    private function addConfigurationSurcharges(): void
    {
        $this->addConfiguration(Group::SURCHARGES . '_START', $this->getConfig(Group::SURCHARGES . '_START_TITLE'), 6, 1, self::class . '::setFunction(');

        $surcharges = json_encode(
            [
                [
                    'name'                         => 'Energiezuschlag',
                    'surcharge'                    => 3.75,
                    'type'                         => 'percent',
                    'configuration[per-package-0]' => 'false',
                ],
                [
                    'name'                         => 'Maut',
                    'surcharge'                    => 0.12,
                    'type'                         => 'fixed',
                    'configuration[per-package-1]' => 'true',
                ],
                [
                    'name'                         => 'Peak',
                    'surcharge'                    => 4.90,
                    'type'                         => 'fixed',
                    'configuration[per-package-2]' => 'false',
                    'duration-start'               => date('Y') . '-10-31',
                    'duration-end'                 => date('Y') + 1 . '-01-15',
                ],
            ]
        );

        $this->addConfiguration('SURCHARGES', $surcharges, 6, 1, self::class . '::setFunction(');

        $pick_and_pack = json_encode(
            [
                [
                    'weight' => 1.00,
                    'cost'   => 1.30,
                ],
                [
                    'weight' => 5.00,
                    'cost'   => 1.60,
                ],
                [
                    'weight' => 10.00,
                    'cost'   =>  2.00,
                ],
                [
                    'weight' => 20.00,
                    'cost'   =>  2.60,
                ],
                [
                    'weight' => 60.00,
                    'cost'   =>  3.00,
                ],
            ],
        );

        $this->addConfiguration(Group::SURCHARGES . '_PICK_AND_PACK', $pick_and_pack, 6, 1, self::class . '::setFunction(');

        $this->addConfigurationSelect(Group::SURCHARGES . '_ROUND_UP', 'true', 6, 1);
        $this->addConfiguration(Group::SURCHARGES . '_ROUND_UP_TO', 0.90, 6, 1, self::class . '::setFunction(');

        $this->addConfiguration(Group::SURCHARGES . '_END', '', 6, 1, self::class . '::setFunction(');
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

        $this->removeConfigurations();
    }

    private function removeConfigurations(): void
    {
        /**
         * Required for modified compatibility
         */
        $this->deleteConfiguration('ALLOWED');
        /** */

        /**
         * Sort Order
         */
        $this->deleteConfiguration('SORT_ORDER');

        /**
         * Debug
         */
        $this->deleteConfiguration('DEBUG_ENABLE');
        /** */

        $this->removeConfigurationWeight();
        $this->removeConfigurationShippingNational();
        $this->removeConfigurationShippingInternational();
        $this->removeConfigurationSurcharges();
    }

    private function removeConfigurationWeight(): void
    {
        $this->deleteConfiguration(Group::SHIPPING_WEIGHT . '_START');
        $this->deleteConfiguration(Group::SHIPPING_WEIGHT . '_MAX');
        $this->deleteConfiguration(Group::SHIPPING_WEIGHT . '_IDEAL');
        $this->deleteConfiguration(Group::SHIPPING_WEIGHT . '_END');
    }

    private function removeConfigurationShippingNational(): void
    {
        $this->deleteConfiguration(Group::SHIPPING_NATIONAL . '_START');
        $this->deleteConfiguration(Group::SHIPPING_NATIONAL . '_COUNTRY');
        $this->deleteConfiguration(Group::SHIPPING_NATIONAL . '_COSTS');
        $this->deleteConfiguration(Group::SHIPPING_NATIONAL . '_END');
    }

    private function removeConfigurationShippingInternational(): void
    {
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_START');

        $this->removeConfigurationShippingInternationalPremium();
        $this->removeConfigurationShippingInternationalEconomy();
        $this->removeConfigurationShippingInternationalExceptions();

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_END');
    }

    private function removeConfigurationShippingInternationalPremium(): void
    {
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_START');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_ENABLE');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_EU');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_BASE_NONEU');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_EU');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z1_PRICE_KG_NONEU');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_BASE');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z2_PRICE_KG');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_EU');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_BASE_NONEU');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_EU');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z3_PRICE_KG_NONEU');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_BASE');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z4_PRICE_KG');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_BASE');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z5_PRICE_KG');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_BASE');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_Z6_PRICE_KG');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_PREMIUM_END');
    }

    private function removeConfigurationShippingInternationalEconomy(): void
    {
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_START');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_ENABLE');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_EU');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_BASE_NONEU');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_EU');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z1_PRICE_KG_NONEU');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_BASE');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z2_PRICE_KG');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_EU');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_BASE_NONEU');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_EU');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z3_PRICE_KG_NONEU');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_BASE');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z4_PRICE_KG');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_BASE');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z5_PRICE_KG');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_BASE');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_Z6_PRICE_KG');

        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_ECONOMY_END');
    }

    private function removeConfigurationShippingInternationalExceptions(): void
    {
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_START');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_DATA');
        $this->deleteConfiguration(Group::SHIPPING_INTERNATIONAL . '_EXCEPTIONS_END');
    }

    private function removeConfigurationSurcharges(): void
    {
        $this->deleteConfiguration(Group::SURCHARGES . '_START');
        $this->deleteConfiguration('SURCHARGES');
        $this->deleteConfiguration(Group::SURCHARGES . '_PICK_AND_PACK');
        $this->deleteConfiguration(Group::SURCHARGES . '_ROUND_UP');
        $this->deleteConfiguration(Group::SURCHARGES . '_ROUND_UP_TO');
        $this->deleteConfiguration(Group::SURCHARGES . '_END');
    }

    /**
     * Used by modified to show shipping costs. Will be ignored if the value is
     * not an array.
     *
     * @var ?array
     */
    public function quote(): ?array
    {
        $quote  = new Quote(self::NAME);
        $quotes = $quote->getQuote();

        if (is_array($quotes)) {
            $this->quotes = $quotes;
        }

        return $quotes;
    }
}
