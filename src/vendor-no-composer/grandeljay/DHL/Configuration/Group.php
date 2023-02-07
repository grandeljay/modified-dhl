<?php

namespace grandeljay\DHL\Configuration;

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
    public static function weightStart(string $value, string $option): string
    {
        return self::start('<h2>' . $value . '</h2>', $option);
    }

    public static function weightEnd(string $value, string $option): string
    {
        return self::end($value, $option);
    }

    /**
     * National
     */
    public static function nationalStart(string $value, string $option): string
    {
        return self::start('<h2>' . $value . '</h2>', $option);
    }

    public static function nationalEnd(string $value, string $option): string
    {
        return self::end($value, $option);
    }

    /**
     * International
     */
    public static function internationalStart(string $value, string $option): string
    {
        return self::start('<h2>' . $value . '</h2>', $option);
    }

    public static function internationalEnd(string $value, string $option): string
    {
        return self::end($value, $option);
    }

    /** Premium */
    public static function internationalPremiumStart(string $value, string $option): string
    {
        return self::start('<h3>' . $value . '</h3>', $option);
    }

    public static function internationalPremiumEnd(string $value, string $option): string
    {
        return self::end($value, $option);
    }

    /** Economy */
    public static function internationalEconomyStart(string $value, string $option): string
    {
        return self::start('<h3>' . $value . '</h3>', $option);
    }

    public static function internationalEconomyEnd(string $value, string $option): string
    {
        return self::end($value, $option);
    }
    /** */

    /**
     * Surcharges
     */
    public static function surchargesStart(string $value, string $option): string
    {
        return self::start('<h2>' . $value . '</h2>', $option);
    }

    public static function surchargesEnd(string $value, string $option): string
    {
        return self::end($value, $option);
    }
}
