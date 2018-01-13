<?php

declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Company;
use Meetup\Entity\User;
use Doctrine\ORM\EntityRepository;
use Meetup\Module;

final class UserRepository extends EntityRepository
{
    public function add($user) : void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush($user);
    }


    public function createUserFromNameAndDescription(string $firstname, string $lastname, Company $company)
    {
        return new User($firstname, $lastname, $company);
    }

    public function editUser(User $user, string $firstname, string $lastame, Company $company)
    {
        $user->setFirstname($firstname);
        $user->setLastname($lastame);
        $user->setCompany($company);

        $this->getEntityManager()->flush($user);
    }

    public function deleteUser(User $user)
    {
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
    }
}
