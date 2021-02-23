<?php

namespace App\Entity\Enum;

class CountryPhoneEnum
{
    public const COUNTRIES = [
        'Cameroon' => [
            'countryCode' => '237',
            'name' => 'Cameroon',
            'regex' => '/^\(237\)\ ?[2368]\d{7,8}$/'
        ],
        'Ethiopia' => [
            'countryCode' => '251',
            'name' => 'Ethiopia',
            'regex' => '/^\(251\)\ ?[1-59]\d{8}$/'
        ],
        'Morocco' => [
            'countryCode' => '212',
            'name' => 'Morocco',
            'regex' => '/^\(212\)\ ?[5-9]\d{8}$/'
        ],
        'Mozambique' => [
            'countryCode' => '258',
            'name' => 'Mozambique',
            'regex' => '/^\(258\)\ ?[28]\d{7,8}$/'
        ],
        'Uganda' => [
            'countryCode' => '256',
            'name' => 'Uganda',
            'regex' => '/^\(256\)\ ?\d{9}$/'
        ]
    ];
}
