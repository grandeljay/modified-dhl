<?php

namespace Grandeljay\Dhl\Configuration;

use RobinTheHood\ModifiedStdModule\Classes\CaseConverter;

class Group
{
    public static function start(string $value, string $option): string
    {
        $key_without_module_name = substr($option, strlen(\grandeljaydhl::NAME) + 1);
        $key_lisp                = CaseConverter::screamingToLisp($key_without_module_name);

        ob_start();
        ?>
        <details class="<?= $key_lisp ?>">
            <summary><?= $value ?></summary>
            <div>
        <?php
        return ob_get_clean();
    }

    public static function end(string $value, string $option): string
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
    public const SHIPPING_WEIGHT = 'SHIPPING_WEIGHT';

    public static function shippingWeightStart(string $value, string $option): string
    {
        return self::start('<h2>' . $value . '</h2>', $option);
    }

    public static function shippingWeightEnd(string $value, string $option): string
    {
        return self::end($value, $option);
    }

    /**
     * National
     */
    public const SHIPPING_NATIONAL = 'SHIPPING_NATIONAL';

    public static function shippingNationalStart(string $value, string $option): string
    {
        return self::start('<h2>' . $value . '</h2>', $option);
    }

    public static function shippingNationalEnd(string $value, string $option): string
    {
        return self::end($value, $option);
    }

    /**
     * International
     */
    public const SHIPPING_INTERNATIONAL = 'SHIPPING_INTERNATIONAL';

    public static function shippingInternationalStart(string $value, string $option): string
    {
        return self::start('<h2>' . $value . '</h2>', $option);
    }

    public static function shippingInternationalEnd(string $value, string $option): string
    {
        return self::end($value, $option);
    }

    /** Premium */
    public static function shippingInternationalPremiumStart(string $value, string $option): string
    {
        return self::start('<h3>' . $value . '</h3>', $option);
    }

    public static function shippingInternationalPremiumEnd(string $value, string $option): string
    {
        return self::end($value, $option);
    }

    /** Economy */
    public static function shippingInternationalEconomyStart(string $value, string $option): string
    {
        return self::start('<h3>' . $value . '</h3>', $option);
    }

    public static function shippingInternationalEconomyEnd(string $value, string $option): string
    {
        return self::end($value, $option);
    }
    /** */

    /** Excptions */
    public static function shippingInternationalExceptionsStart(string $value, string $option): string
    {
        return self::start('<h3>' . $value . '</h3>', $option);
    }

    public static function shippingInternationalExceptionsEnd(string $value, string $option): string
    {
        return self::end($value, $option);
    }
    /** */

    /**
     * Surcharges
     */
    public const SURCHARGES = 'SURCHARGES';

    public static function surchargesStart(string $value, string $option): string
    {
        return self::start('<h2>' . $value . '</h2>', $option);
    }

    public static function surchargesEnd(string $value, string $option): string
    {
        return self::end($value, $option);
    }
}
