<?php

declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityRepository;
use Meetup\Module;

final class MeetupRepository extends EntityRepository
{
    public function add($meetup) : void
    {
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);
    }


    public function createMeetupFromNameAndDescription(string $name, string $description, string $stime, string $etime)
    {
        return new Meetup($name, $description, $stime, $etime);
    }

    public function editMeetup(Meetup $meetup, string $name, string $description, string $stime, string $etime)
    {
        $meetup->setTitle($name);
        $meetup->setDescription($description);
        $meetup->setStime($stime);
        $meetup->setEtime($etime);

        $this->getEntityManager()->flush($meetup);
    }

    public function deleteMeetup(Meetup $meetup)
    {
        $this->getEntityManager()->remove($meetup);
        $this->getEntityManager()->flush();
    }
}
