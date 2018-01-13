<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Doctrine\ORM\EntityManager;
use Meetup\Entity\Company;
use Meetup\Entity\User;
use Meetup\Form\UserForm;
use Psr\Container\ContainerInterface;

final class UserControllerFactory
{
    public function __invoke(ContainerInterface $container) : UserController
    {
        $userRepository = $container->get(EntityManager::class)->getRepository(User::class);
        $companyRepository = $container->get(EntityManager::class)->getRepository(Company::class);

        return new UserController($userRepository, $companyRepository);
    }
}
