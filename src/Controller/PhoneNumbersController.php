<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Customer;
use App\Entity\Enum\CountryPhoneEnum;

class PhoneNumbersController extends AbstractController
{    
    /**
     * @Route("/", name="phone-numbers", methods={"GET"})
     */
    public function showPhoneNumberList(Request $request): Response
    {
        $country = $page = $request->query->get('country', '');
        $valid = $page = $request->query->get('valid', '');
        $phoneNumbers = $this->getFilteredPhoneNumbers($country, $valid);
        
        return $this->render('phone/numbers.html.twig', [
            'phoneNumbers' => $phoneNumbers,
            'countries' => array_column(CountryPhoneEnum::COUNTRIES, 'name'),
            'selectedCountry' => $country,
            'selectedValid' => $valid
        ]);
    }
    
    private function getFilteredPhoneNumbers(string $country, string $valid): array 
    {        
        return array_filter(
            $this->getAllPhoneNumbers($country), 
            function ($phoneNumber) use ($valid) 
            {   
                if (
                    !empty($valid) && 
                    $phoneNumber->isValid() != ($valid == 1 ?: false)
                ) {
                    return false;
                }
                
                return true;
            }
        );
    }
    
    private function getAllPhoneNumbers(string $country): array 
    {
        $customers = $this->getDoctrine()
            ->getRepository(Customer::class)
            ->findAllByCountryCode($country);

        return array_map(
            function ($customer) 
            {
                return $customer->getPhone();
            }, 
            $customers
        );
    }
}