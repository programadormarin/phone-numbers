<?php

namespace App\Tests\Entity\ValueObject;

use PHPUnit\Framework\TestCase;
use App\Entity\ValueObject\PhoneNumber;

class PhoneNumberTest extends TestCase
{
    /**
     * @test
     * @dataProvider getPhonesNumbers
     */
    public function configureSetInvalidPhoneNumber(array $phoneData) 
    {
        $phoneNumber = new PhoneNumber($phoneData['phone']);
        $phoneNumber->configure();
        
        $this->assertEquals($phoneData['phone'], $phoneNumber->getPhone());
        $this->assertEquals($phoneData['number'], $phoneNumber->getNumber());
        $this->assertEquals($phoneData['country'], $phoneNumber->getCountry());
        $this->assertEquals($phoneData['countryCode'], $phoneNumber->getCountryCode());
        $this->assertEquals($phoneData['isValid'], $phoneNumber->isValid());
    }
    
    /**
     * 
     */
    public function getPhonesNumbers(): array
    {
        return [
            [[
                'phone' => '(212) 6007989253',
                'number' => '6007989253',
                'country' => 'Morocco',
                'countryCode' => '+212',
                'isValid' => false,
            ]],
            [[
                'phone' => '(212) 6546545369',
                'number' => '6546545369',
                'country' => 'Morocco',
                'countryCode' => '+212',
                'isValid' => false,
            ]],
            [[
                'phone' => '(212) 6617344445',
                'number' => '6617344445',
                'country' => 'Morocco',
                'countryCode' => '+212',
                'isValid' => false,
            ]],
            [[
                'phone' => '(258) 84330678235',
                'number' => '84330678235',
                'country' => 'Mozambique',
                'countryCode' => '+258',
                'isValid' => false,
            ]],
            [[
                'phone' => '(256) 7503O6263',
                'number' => '7503O6263',
                'country' => 'Uganda',
                'countryCode' => '+256',
                'isValid' => false,
            ]],
            [[
                'phone' => '(251) 9119454961',
                'number' => '9119454961',
                'country' => 'Ethiopia',
                'countryCode' => '+251',
                'isValid' => false,
            ]],
            [[
                'phone' => '(237) 6780009592',
                'number' => '6780009592',
                'country' => 'Cameroon',
                'countryCode' => '+237',
                'isValid' => false,
            ]],
            [[
                'phone' => '(212) 698054317',
                'number' => '698054317',
                'country' => 'Morocco',
                'countryCode' => '+212',
                'isValid' => true,
            ]],
            [[
                'phone' => '(212) 691933626',
                'number' => '691933626',
                'country' => 'Morocco',
                'countryCode' => '+212',
                'isValid' => true,
            ]],
            [[
                'phone' => '(212) 633963130',
                'number' => '633963130',
                'country' => 'Morocco',
                'countryCode' => '+212',
                'isValid' => true,
            ]],
            [[
                'phone' => '(258) 846565883',
                'number' => '846565883',
                'country' => 'Mozambique',
                'countryCode' => '+258',
                'isValid' => true,
            ]],
            [[
                'phone' => '(256) 704244430',
                'number' => '704244430',
                'country' => 'Uganda',
                'countryCode' => '+256',
                'isValid' => true,
            ]],
            [[
                'phone' => '(251) 914701723',
                'number' => '914701723',
                'country' => 'Ethiopia',
                'countryCode' => '+251',
                'isValid' => true,
            ]],
            [[
                'phone' => '(237) 697151594',
                'number' => '697151594',
                'country' => 'Cameroon',
                'countryCode' => '+237',
                'isValid' => true,
            ]],
            [[
                'phone' => '(256) 70424-4430',
                'number' => '70424-4430',
                'country' => 'Uganda',
                'countryCode' => '+256',
                'isValid' => false,
            ]],
            [[
                'phone' => '(237) 697151 594',
                'number' => '697151 594',
                'country' => 'Cameroon',
                'countryCode' => '+237',
                'isValid' => false,
            ]],
            [[
                'phone' => '(212) 6339A63130',
                'number' => '6339A63130',
                'country' => 'Morocco',
                'countryCode' => '+212',
                'isValid' => false,
            ]]
        ];
    }
}
