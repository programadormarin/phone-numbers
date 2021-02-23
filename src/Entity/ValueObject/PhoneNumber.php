<?php

namespace App\Entity\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Enum\CountryPhoneEnum;

/**
 * @ORM\Embeddable()
 * @ORM\HasLifecycleCallbacks()
 */
class PhoneNumber
{
    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $countryCode;
    
    /**
     * @var boolean
     */
    private $isValid;
    
    public function __construct(string $phone) 
    {
        $this->phone = $phone;
    }
    
    public function getPhone(): string
    {
        return $this->phone;
    }
    
    public function getNumber(): string
    {
        return $this->number;
    }
    
    public function getCountry(): string
    {
        return $this->country;
    }
    
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
    
    public function isValid(): bool
    {
        return $this->isValid;
    }
    
    public function configure() 
    {
        preg_match('/^\((?P<code>\d{3})\)\ ?(\d)/', $this->phone, $matches);
        
        foreach(CountryPhoneEnum::COUNTRIES as $country) {
            if ($matches['code'] === $country['countryCode']) {
                $this->populatePhoneNumber($country);
                
                break;
            }
        }
    }
    
    private function populatePhoneNumber(array $country) 
    {
        $this->isValid = false;
        $this->countryCode = '+' . $country['countryCode'];
        $this->country = $country['name'];
        $this->number = str_replace(
            '(' . $country['countryCode'] . ') ', 
            '', 
            $this->phone
        );

        if (preg_match($country['regex'], $this->phone)) {
            $this->isValid = true;
        }
    }
}