<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Enum\CountryPhoneEnum;

class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    /**
     * @return Customer[]
     */
    public function findAllByCountryCode(string $countryName): array
    {
        if (empty($countryName)) {
            return $this->findAll();
        }
        
        $country = CountryPhoneEnum::COUNTRIES[$countryName];
        
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c
                FROM App\Entity\Customer c
                WHERE c.phone.phone LIKE :code'
            )
            ->setParameter('code', '(' . $country['countryCode'] . ')%')
            ->getResult();
    }
}
