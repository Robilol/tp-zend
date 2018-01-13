<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Cinema\Entity\Film;
use Cinema\Form\FilmForm;
use Doctrine\ORM\EntityManager;
use Meetup\Entity\Meetup;
use Meetup\Form\MeetupForm;
use Psr\Container\ContainerInterface;

final class MeetupControllerFactory
{
    public function __invoke(ContainerInterface $container) : MeetupController
    {
        $meetupRepository = $container->get(EntityManager::class)->getRepository(Meetup::class);
        $meetupForm = $container->get(MeetupForm::class);

        return new MeetupController($meetupRepository, $meetupForm);
    }
}
