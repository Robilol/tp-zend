<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Doctrine\ORM\EntityManager;
use Meetup\Entity\User;
use Meetup\Form\UserForm;
use Psr\Container\ContainerInterface;

final class UserControllerFactory
{
    public function __invoke(ContainerInterface $container) : UserController
    {
        $userRepository = $container->get(EntityManager::class)->getRepository(User::class);
        $userForm = $container->get(UserForm::class);

        return new UserController($userRepository, $userForm);
    }
}
