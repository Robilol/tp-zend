<?php

declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Company;
use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityRepository;
use Meetup\Entity\User;
use Meetup\Module;

final class MeetupRepository extends EntityRepository
{
    public function add($meetup) : void
    {
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);
    }


    public function createMeetupFromNameAndDescription(string $name, string $description, string $stime, string $etime, User $creator, Company $company, $participants)
    {
        $meetup = new Meetup($name, $description, $stime, $etime, $creator, $company);

        foreach ($participants as $participant) /* @var $participant \Meetup\Entity\User */
        {
            $meetup->addParticipant($participant);
        }
        return $meetup;
    }

    public function editMeetup(Meetup $meetup, string $name, string $description, string $stime, string $etime, User $creator, Company $company, $participants)
    {
        $meetup->setTitle($name);
        $meetup->setDescription($description);
        $meetup->setStime($stime);
        $meetup->setEtime($etime);
        $meetup->setCreator($creator);
        $meetup->setCompany($company);
        $meetup->clearParticipant();

        foreach ($participants as $participant) /* @var $participant \Meetup\Entity\User */
        {
            $meetup->addParticipant($participant);
        }

        $this->getEntityManager()->flush($meetup);
    }

    public function deleteMeetup(Meetup $meetup)
    {
        $this->getEntityManager()->remove($meetup);
        $this->getEntityManager()->flush();
    }
}
