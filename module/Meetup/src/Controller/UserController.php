<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Entity\Meetup;
use Meetup\Form\UserForm;
use Meetup\Repository\CompanyRepository;
use Meetup\Repository\MeetupRepository;
use Meetup\Form\MeetupForm;
use Meetup\Repository\UserRepository;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class UserController extends AbstractActionController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    public function __construct(UserRepository $userRepository, CompanyRepository $companyRepository)
    {
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
    }

    public function indexAction()
    {
        return new ViewModel([
            'users' => $this->userRepository->findAll(),
        ]);
    }

    public function addAction()
    {
        $companies = $this->companyRepository->findAll();

        $form = new UserForm($companies);

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $user = $this->userRepository->createUser(
                    $form->getData()['firstname'],
                    $form->getData()['lastname'],
                    $this->companyRepository->find($form->getData()['company'])
                );
                $this->userRepository->add($user);
                return $this->redirect()->toRoute('user');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function editAction()
    {
        $userId = $this->params()->fromRoute('id');

        $user = $this->userRepository->find($userId);

        $companies = $this->companyRepository->findAll();

        $form = new UserForm($companies);

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->userRepository->edituser(
                    $user,
                    $form->getData()['firstname'],
                    $form->getData()['lastname'],
                    $this->companyRepository->find($form->getData()['company'])
                );
                return $this->redirect()->toRoute('user');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
            'user' => $user,
        ]);
    }

    public function showAction()
    {
        $userId = $this->params()->fromRoute('id');

        $user = $this->userRepository->find($userId);

        return new ViewModel([
            'user' => $user,
        ]);
    }

    public function deleteAction()
    {
        $userId = $this->params()->fromRoute('id');

        $user = $this->userRepository->find($userId);

        $this->userRepository->deleteuser($user);

        return $this->redirect()->toRoute('user');
    }
}
