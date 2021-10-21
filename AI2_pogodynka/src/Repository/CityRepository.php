<?php

namespace App\Repository;

use App\Entity\Measurement;
use App\Entity\City;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, City::class);
    }

    public function findByName(string $country, string $city_name)
    {
        $qb = $this->createQueryBuilder('c');
        $qb->where('c.country = :country')
            ->setParameter('country', $country)
            ->andWhere('c.name = :city_name')
            ->setParameter('city_name', $city_name);

        $query = $qb->getQuery();
        $result = $query->getSingleResult();

        return $result;
    }
}
