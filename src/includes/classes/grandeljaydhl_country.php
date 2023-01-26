<?php

class grandeljaydhl_country
{
    /**
     * List of countries which are part of the EU.
     *
     * @see https://ec.europa.eu/eurostat/statistics-explained/index.php?title=Glossary:Country_codes
     *
     * @var array
     */
    private static array $countries_eu = array(
        'BE' => 'Belgium',
        'BG' => 'Bulgaria',
        'CZ' => 'Czechia',
        'DK' => 'Denmark',
        'DE' => 'Germany',
        'EE' => 'Estonia',
        'IE' => 'Ireland',
        'EL' => 'Greece',
        'ES' => 'Spain',
        'FR' => 'France',
        'HR' => 'Croatia',
        'IT' => 'Italy',
        'CY' => 'Cyprus',
        'LV' => 'Latvia',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'HU' => 'Hungary',
        'MT' => 'Malta',
        'NL' => 'Netherlands',
        'AT' => 'Austria',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'RO' => 'Romania',
        'SI' => 'Slovenia',
        'SK' => 'Slovakia',
        'FI' => 'Finland',
        'SE' => 'Sweden',
    );

    /**
     * List of countries which DHL marks as "non-eu"
     *
     * @see https://ec.europa.eu/eurostat/statistics-explained/index.php?title=Glossary:Country_codes
     *
     * @var array
     */
    private static array $countries_noneu = array(
        'BA' => 'Bosnia and Herzegovina', /** EU candidate */
        'AL' => 'Albania',                /** EU candidate */
        'FO' => 'Faroes',
        'GL' => 'Greenland',
        'IS' => 'Iceland',                /** European Free Trade Association (EFTA) */
        'LI' => 'Liechtenstein',          /** European Free Trade Association (EFTA) */
        'MK' => 'North Macedonia',        /** EU candidate */
        'MD' => 'Moldova',                /** EU candidate */
        'ME' => 'Montenegro',             /** EU candidate */
        'NO' => 'Norway',                 /** European Free Trade Association (EFTA) */
        'CH' => 'Switzerland',            /** European Free Trade Association (EFTA) */
        'RS' => 'Serbia',                 /** EU candidate */
        'UA' => 'Ukraine',                /** EU candidate */
        'BY' => 'Weißrussland',           /** European Neighbourhood Policy (ENP)-East country */
    );

    private int $zone;
    private string $iso_code_2;
    private string $iso_code_3;
    private string $name;

    private bool $is_eu;
    private bool $is_noneu;

    private float $price_premium_base;
    private float $price_premium_kg;
    private float $price_economy_base;
    private float $price_economy_kg;

    public function __construct(array $country)
    {
        /**
         * Guess type based on value.
         */
        foreach ($country as $value) {
            /** Zone */
            if (1 === preg_match('/^\d+$/', $value, $id)) {
                $this->zone = $id[0];

                continue;
            }

            /** ISO code 2 */
            if (1 === preg_match('/^[A-Z]{2}$/', $value, $iso_code_2)) {
                $this->iso_code_2 = $iso_code_2[0];

                continue;
            }

            /** ISO code 3 */
            if (1 === preg_match('/^[A-Z]{3}$/', $value, $iso_code_3)) {
                $this->iso_code_3 = $iso_code_3[0];

                continue;
            }

            /** Name */
            if (is_string($value)) {
                $this->name = $value;

                continue;
            }
        }

        /**
         * Is EU
         */
        $country_codes_eu = array_keys(self::$countries_eu);

        $this->in_eu = in_array($this->iso_code_2, $country_codes_eu, true);

        /**
         * Is Non-EU
         */
        $country_codes_noneu = array_keys(self::$countries_noneu);

        $this->in_noneu = in_array($this->iso_code_2, $country_codes_noneu, true);
    }

    public function getZone(): int
    {
        return $this->zone;
    }

    /**
     * Get or set whether this country is part of the European Union (EU).
     *
     * @param boolean|null $is_eu
     *
     * @return boolean
     */
    public function isInEU(bool|null $is_eu = null): bool
    {
        /** Get */
        if (null === $is_eu) {
            return $this->in_eu;
        }
    }
}
