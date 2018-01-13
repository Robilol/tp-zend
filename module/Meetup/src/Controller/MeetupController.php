<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Entity\Meetup;
use Meetup\Repository\MeetupRepository;
use Meetup\Form\MeetupForm;
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
     * @var MeetupForm
     */
    private $meetupForm;

    public function __construct(MeetupRepository $meetupRepository, MeetupForm $meetupForm)
    {
        $this->meetupRepository = $meetupRepository;
        $this->meetupForm = $meetupForm;
    }

    public function indexAction()
    {
        return new ViewModel([
            'meetups' => $this->meetupRepository->findAll(),
        ]);
    }

    public function addAction()
    {
        $form = $this->meetupForm;

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $meetup = $this->meetupRepository->createMeetupFromNameAndDescription(
                    $form->getData()['title'],
                    $form->getData()['description'] ?? '',
                    $form->getData()['stime'],
                    $form->getData()['etime']
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

        $form = $this->meetupForm;

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->meetupRepository->editMeetup(
                    $meetup,
                    $form->getData()['title'],
                    $form->getData()['description'] ?? '',
                    $form->getData()['stime'],
                    $form->getData()['etime']
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
