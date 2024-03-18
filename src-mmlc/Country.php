<?php

namespace Grandeljay\Dhl;

class Country
{
    /**
     * Countries and their zone
     *
     * @var array
     */
    private static array $countries_zone = [
        1   => 5,
        /** Afghanistan */
        2   => 3,
        /** Albania */
        3   => 4,
        /** Algeria */
        // 4 =>   /** American Samoa */
        5   => 2,
        /** Andorra */
        6   => 6,
        /** Angola */
        7   => 6,
        /** Anguilla */
        // 8 =>   /** Antarctica */
        9   => 6,
        /** Antigua and Barbuda */
        10  => 6,
        /** Argentina */
        11  => 5,
        /** Armenia */
        12  => 6,
        /** Aruba */
        13  => 6,
        /** Australia */
        14  => 1,
        /** Austria */
        15  => 5,
        /** Azerbaijan */
        16  => 6,
        /** Bahamas */
        17  => 5,
        /** Bahrain */
        18  => 5,
        /** Bangladesh */
        19  => 6,
        /** Barbados */
        20  => 3,
        /** Belarus */
        21  => 1,
        /** Belgium */
        22  => 6,
        /** Belize */
        23  => 6,
        /** Benin */
        24  => 6,
        /** Bermuda */
        25  => 5,
        /** Bhutan */
        26  => 6,
        /** Bolivia */
        27  => 3,
        /** Bosnia and Herzegowina */
        28  => 6,
        /** Botswana */
        // 29 =>  /** Bouvet Island */
        30  => 6,
        /** Brazil */
        31  => 6,
        /** British Indian Ocean Territory */
        32  => 5,
        /** Brunei Darussalam */
        33  => 3,
        /** Bulgaria */
        34  => 6,
        /** Burkina Faso */
        35  => 6,
        /** Burundi */
        36  => 5,
        /** Cambodia */
        37  => 6,
        /** Cameroon */
        38  => 5,
        /** Canada */
        39  => 6,
        /** Cape Verde */
        40  => 6,
        /** Cayman Islands */
        41  => 6,
        /** Central African Republic */
        42  => 6,
        /** Chad */
        43  => 6,
        /** Chile */
        44  => 5,
        /** China */
        // 45 =>  /** Christmas Island */
        // 46 =>  /** Cocos (Keeling) Islands */
        47  => 6,
        /** Colombia */
        48  => 6,
        /** Comoros */
        // 49 =>  /** Congo */
        // 50 =>  /** Cook Islands */
        51  => 6,
        /** Costa Rica */
        // 52 =>  /** Cote D'Ivoire */
        53  => 3,
        /** Croatia */
        54  => 6,
        /** Cuba */
        55  => 3,
        /** Cyprus */
        56  => 1,
        /** Czech Republic */
        57  => 1,
        /** Denmark */
        58  => 6,
        /** Djibouti */
        59  => 6,
        /** Dominica */
        60  => 6,
        /** Dominican Republic */
        61  => 5,
        /** East Timor */
        62  => 6,
        /** Ecuador */
        63  => 4,
        /** Egypt */
        64  => 6,
        /** El Salvador */
        65  => 6,
        /** Equatorial Guinea */
        66  => 6,
        /** Eritrea */
        67  => 3,
        /** Estonia */
        68  => 6,
        /** Ethiopia */
        69  => 6,
        /** Falkland Islands (Malvinas) */
        70  => 3,
        /** Faroe Islands */
        71  => 6,
        /** Fiji */
        72  => 3,
        /** Finland */
        73  => 1,
        /** France */
        75  => 6,
        /** French Guiana */
        76  => 6,
        /** French Polynesia */
        77  => 6,
        /** French Southern Territories */
        78  => 6,
        /** Gabon */
        79  => 6,
        /** Gambia */
        80  => 4,
        /** Georgia */
        81  => 1,
        /** Germany */
        82  => 6,
        /** Ghana */
        // 83 =>  /** Gibraltar */
        84  => 3,
        /** Greece */
        85  => 3,
        /** Greenland */
        86  => 6,
        /** Grenada */
        87  => 6,
        /** Guadeloupe */
        // 88 =>  /** Guam */
        89  => 6,
        /** Guatemala */
        90  => 6,
        /** Guinea */
        91  => 6,
        /** Guinea-bissau */
        92  => 6,
        /** Guyana */
        93  => 6,
        /** Haiti */
        // 94 =>  /** Heard and Mc Donald Islands */
        95  => 6,
        /** Honduras */
        // 96 =>  /** Hong Kong */
        97  => 2,
        /** Hungary */
        98  => 3,
        /** Iceland */
        99  => 5,
        /** India */
        100 => 5,
        /** Indonesia */
        101 => 5,
        /** Iran (Islamic Republic of) */
        102 => 5,
        /** Iraq */
        103 => 3,
        /** Ireland */
        104 => 4,
        /** Israel */
        105 => 2,
        /** Italy */
        106 => 6,
        /** Jamaica */
        107 => 5,
        /** Japan */
        108 => 5,
        /** Jordan */
        109 => 5,
        /** Kazakhstan */
        110 => 6,
        /** Kenya */
        111 => 6,
        /** Kiribati */
        112 => 5,
        /** Korea, Democratic People's Republic of */
        113 => 5,
        /** Korea, Republic of */
        114 => 5,
        /** Kuwait */
        115 => 5,
        /** Kyrgyzstan */
        116 => 5,
        /** Lao People's Democratic Republic */
        117 => 3,
        /** Latvia */
        118 => 4,
        /** Lebanon */
        119 => 6,
        /** Lesotho */
        120 => 6,
        /** Liberia */
        121 => 4,
        /** Libyan Arab Jamahiriya */
        122 => 1,
        /** Liechtenstein */
        123 => 3,
        /** Lithuania */
        124 => 1,
        /** Luxembourg */
        // 125 => /** Macau */
        126 => 3,
        /** North Macedonia */
        127 => 6,
        /** Madagascar */
        128 => 6,
        /** Malawi */
        129 => 5,
        /** Malaysia */
        130 => 5,
        /** Maldives */
        131 => 6,
        /** Mali */
        132 => 3,
        /** Malta */
        133 => 6,
        /** Marshall Islands */
        134 => 6,
        /** Martinique */
        135 => 6,
        /** Mauritania */
        136 => 6,
        /** Mauritius */
        137 => 6,
        /** Mayotte */
        138 => 5,
        /** Mexico */
        139 => 6,
        /** Micronesia, Federated States of */
        140 => 3,
        /** Moldova, Republic of */
        141 => 1,
        /** Monaco */
        142 => 5,
        /** Mongolia */
        143 => 6,
        /** Montserrat */
        144 => 4,
        /** Morocco */
        145 => 6,
        /** Mozambique */
        146 => 5,
        /** Myanmar */
        147 => 6,
        /** Namibia */
        148 => 6,
        /** Nauru */
        149 => 5,
        /** Nepal */
        150 => 1,
        /** Netherlands */
        151 => 6,
        /** Netherlands Antilles */
        152 => 6,
        /** New Caledonia */
        153 => 6,
        /** New Zealand */
        154 => 6,
        /** Nicaragua */
        155 => 6,
        /** Niger */
        156 => 6,
        /** Nigeria */
        // 157 => /** Niue */
        // 158 => /** Norfolk Island */
        // 159 => /** Northern Mariana Islands */
        160 => 3,
        /** Norway */
        161 => 5,
        /** Oman */
        162 => 5,
        /** Pakistan */
        163 => 6,
        /** Palau */
        164 => 6,
        /** Panama */
        165 => 5,
        /** Papua New Guinea */
        166 => 6,
        /** Paraguay */
        167 => 6,
        /** Peru */
        168 => 5,
        /** Philippines */
        169 => 6,
        /** Pitcairn */
        170 => 1,
        /** Poland */
        171 => 3,
        /** Portugal */
        // 172 => /** Puerto Rico */
        173 => 5,
        /** Qatar */
        174 => 6,
        /** Reunion */
        175 => 3,
        /** Romania */
        176 => 4,
        /** Russian Federation */
        177 => 6,
        /** Rwanda */
        178 => 6,
        /** Saint Kitts and Nevis */
        179 => 6,
        /** Saint Lucia */
        180 => 6,
        /** Saint Vincent and the Grenadines */
        181 => 6,
        /** Samoa */
        182 => 2,
        /** San Marino */
        183 => 6,
        /** Sao Tome and Principe */
        184 => 5,
        /** Saudi Arabia */
        185 => 6,
        /** Senegal */
        186 => 6,
        /** Seychelles */
        187 => 6,
        /** Sierra Leone */
        188 => 5,
        /** Singapore */
        189 => 2,
        /** Slovakia (Slovak Republic) */
        190 => 2,
        /** Slovenia */
        191 => 6,
        /** Solomon Islands */
        192 => 6,
        /** Somalia */
        193 => 6,
        /** South Africa */
        // 194 => /** South Georgia and the South Sandwich Islands */
        195 => 2,
        /** Spain */
        196 => 5,
        /** Sri Lanka */
        197 => 6,
        /** St. Helena */
        198 => 6,
        /** St. Pierre and Miquelon */
        199 => 6,
        /** Sudan */
        200 => 6,
        /** Suriname */
        // 201 => /** Svalbard and Jan Mayen Islands */
        // 202 => /** Swaziland */
        203 => 2,
        /** Sweden */
        204 => 1,
        /** Switzerland */
        205 => 4,
        /** Syrian Arab Republic */
        206 => 5,
        /** Taiwan */
        207 => 5,
        /** Tajikistan */
        208 => 6,
        /** Tanzania, United Republic of */
        209 => 5,
        /** Thailand */
        210 => 6,
        /** Togo */
        // 211 => /** Tokelau */
        212 => 6,
        /** Tonga */
        213 => 6,
        /** Trinidad and Tobago */
        214 => 4,
        /** Tunisia */
        215 => 4,
        /** Turkey */
        216 => 5,
        /** Turkmenistan */
        217 => 6,
        /** Turks and Caicos Islands */
        218 => 6,
        /** Tuvalu */
        219 => 6,
        /** Uganda */
        220 => 3,
        /** Ukraine */
        // 221 => /** United Arab Emirates */
        222 => 2,
        /** United Kingdom */
        223 => 5,
        /** United States */
        // 224 => /** United States Minor Outlying Islands */
        225 => 6,
        /** Uruguay */
        226 => 5,
        /** Uzbekistan */
        227 => 6,
        /** Vanuatu */
        228 => 2,
        /** Vatican City State (Holy See) */
        229 => 6,
        /** Venezuela */
        230 => 5,
        /** Viet Nam */
        231 => 6,
        /** Virgin Islands (British) */
        // 232 => /** Virgin Islands (U.S.) */
        233 => 6,
        /** Wallis and Futuna Islands */
        // 234 => /** Western Sahara */
        235 => 5,
        /** Yemen */
        // 237 => /** Zaire */
        238 => 6,
        /** Zambia */
        239 => 6,
        /** Zimbabwe */
        240 => 3,
        /** Serbia */
        241 => 3, /** Montenegro */
        // 242 => /** Kosovo */
    ];

    /**
     * List of countries which are part of the EU.
     *
     * @see https://ec.europa.eu/eurostat/statistics-explained/index.php?title=Glossary:Country_codes
     *
     * @var array
     */
    private static array $countries_eu = [
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
    ];

    /**
     * List of countries which DHL marks as "non-eu"
     *
     * @see https://ec.europa.eu/eurostat/statistics-explained/index.php?title=Glossary:Country_codes
     *
     * @var array
     */
    private static array $countries_noneu = [
        'BA' => 'Bosnia and Herzegovina',
        /** EU candidate */
        'AL' => 'Albania',
        /** EU candidate */
        'FO' => 'Faroes',
        'GL' => 'Greenland',
        'IS' => 'Iceland',
        /** European Free Trade Association (EFTA) */
        'LI' => 'Liechtenstein',
        /** European Free Trade Association (EFTA) */
        'MK' => 'North Macedonia',
        /** EU candidate */
        'MD' => 'Moldova',
        /** EU candidate */
        'ME' => 'Montenegro',
        /** EU candidate */
        'NO' => 'Norway',
        /** European Free Trade Association (EFTA) */
        'CH' => 'Switzerland',
        /** European Free Trade Association (EFTA) */
        'RS' => 'Serbia',
        /** EU candidate */
        'UA' => 'Ukraine',
        /** EU candidate */
        'BY' => 'Weißrussland', /** European Neighbourhood Policy (ENP)-East country */
    ];

    private int $zone;
    private string $iso_code_2;
    private string $iso_code_3;
    private string $name;

    private int $country_id;

    public function __construct(array $country)
    {
        /**
         * Guess type based on value.
         */
        foreach ($country as $value) {
            /** Country ID */
            if (1 === preg_match('/^\d+$/', $value, $match_country_id)) {
                $this->country_id = $match_country_id[0];

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
         * Zone
         */
        if (isset($this->country_id)) {
            $zone = isset(self::$countries_zone[$this->country_id]) ? self::$countries_zone[$this->country_id] : -1;

            if (-1 === $zone) {
                throw new Exception(sprintf('%s is not a valid country ID. Zone unknown.', $this->country_id));
            }

            $this->zone = $zone;
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

    public function getCountryID(): int
    {
        return $this->country_id;
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
    public function getIsEU(bool|null $is_eu = null): bool
    {
        /** Get */
        if (null === $is_eu) {
            return $this->in_eu;
        }
    }

    public function getCountryCode(): string
    {
        return $this->iso_code_2;
    }
}
