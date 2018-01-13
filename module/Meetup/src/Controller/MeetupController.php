<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Entity\Meetup;
use Meetup\Repository\CompanyRepository;
use Meetup\Repository\MeetupRepository;
use Meetup\Form\MeetupForm;
use Meetup\Repository\UserRepository;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class MeetupController extends AbstractActionController
{
    /**
     * @var MeetupRepository
     */
    private $meetupRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    public function __construct(MeetupRepository $meetupRepository, UserRepository $userRepository, CompanyRepository $companyRepository)
    {
        $this->meetupRepository = $meetupRepository;
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
    }

    public function indexAction()
    {
        return new ViewModel([
            'meetups' => $this->meetupRepository->findAll(),
        ]);
    }

    public function addAction()
    {
        $users = $this->userRepository->findAll();
        $companies = $this->companyRepository->findAll();

        $form = new MeetupForm($users, $companies);

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $participantsUser = [];

                foreach ($form->getData()['participants'] as $participant) {
                    $participantsUser[] = $this->userRepository->find($participant);
                }

                $meetup = $this->meetupRepository->createMeetupFromNameAndDescription(
                    $form->getData()['title'],
                    $form->getData()['description'] ?? '',
                    $form->getData()['stime'],
                    $form->getData()['etime'],
                    $this->userRepository->find($form->getData()['creator']),
                    $this->companyRepository->find($form->getData()['company']),
                    $participantsUser
                );
                $this->meetupRepository->add($meetup);
                return $this->redirect()->toRoute('meetup');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function editAction()
    {
        $meetupId = $this->params()->fromRoute('id');

        $meetup = $this->meetupRepository->find($meetupId);

        $users = $this->userRepository->findAll();
        $companies = $this->companyRepository->findAll();

        $form = new MeetupForm($users, $companies);

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $participantsUser = [];

                foreach ($form->getData()['participants'] as $participant) {
                    $participantsUser[] = $this->userRepository->find($participant);
                }

                $meetup = $this->meetupRepository->editMeetup(
                    $meetup,
                    $form->getData()['title'],
                    $form->getData()['description'] ?? '',
                    $form->getData()['stime'],
                    $form->getData()['etime'],
                    $this->userRepository->find($form->getData()['creator']),
                    $this->companyRepository->find($form->getData()['company']),
                    $participantsUser
                );
                return $this->redirect()->toRoute('meetup');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
            'meetup' => $meetup,
        ]);
    }

    public function showAction()
    {
        $meetupId = $this->params()->fromRoute('id');

        $meetup = $this->meetupRepository->find($meetupId);

        return new ViewModel([
            'meetup' => $meetup,
        ]);
    }

    public function deleteAction()
    {
        $meetupId = $this->params()->fromRoute('id');

        $meetup = $this->meetupRepository->find($meetupId);

        $this->meetupRepository->deleteMeetup($meetup);

        return $this->redirect()->toRoute('meetup');
    }
}
