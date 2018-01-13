<?php

declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Company;
use Doctrine\ORM\EntityRepository;
use Meetup\Module;

final class CompanyRepository extends EntityRepository
{
    public function add($company) : void
    {
        $this->getEntityManager()->persist($company);
        $this->getEntityManager()->flush($company);
    }


    public function createCompany(string $name, string $address, string $city)
    {
        return new Company($name, $address, $city);
    }

    public function editCompany(Company $company, string $name, string $address, string $city)
    {
        $company->setName($name);
        $company->setAddress($address);
        $company->setCity($city);

        $this->getEntityManager()->flush($company);
    }

    public function deleteCompany(Company $company)
    {
        $this->getEntityManager()->remove($company);
        $this->getEntityManager()->flush();
    }
}
