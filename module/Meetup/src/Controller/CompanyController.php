<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Form\CompanyForm;
use Meetup\Repository\CompanyRepository;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class CompanyController extends AbstractActionController
{
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * @var CompanyForm
     */
    private $companyForm;

    public function __construct(CompanyRepository $companyRepository, CompanyForm $companyForm)
    {
        $this->companyRepository = $companyRepository;
        $this->companyForm = $companyForm;
    }

    public function indexAction()
    {
        return new ViewModel([
            'companies' => $this->companyRepository->findAll(),
        ]);
    }

    public function addAction()
    {
        $form = $this->companyForm;

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $company = $this->companyRepository->createCompany(
                    $form->getData()['name'],
                    $form->getData()['address'],
                    $form->getData()['city']
                );
                $this->companyRepository->add($company);
                return $this->redirect()->toRoute('company');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function editAction()
    {
        $companyId = $this->params()->fromRoute('id');

        $company = $this->companyRepository->find($companyId);

        $form = $this->companyForm;

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->companyRepository->editCompany(
                    $company,
                    $form->getData()['name'],
                    $form->getData()['address'],
                    $form->getData()['city']
                );
                return $this->redirect()->toRoute('company');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
            'company' => $company,
        ]);
    }

    public function showAction()
    {
        $companyId = $this->params()->fromRoute('id');

        $company = $this->companyRepository->find($companyId);

        return new ViewModel([
            'company' => $company,
        ]);
    }

    public function deleteAction()
    {
        $companyId = $this->params()->fromRoute('id');

        $company = $this->companyRepository->find($companyId);

        $this->companyRepository->deletecompany($company);

        return $this->redirect()->toRoute('company');
    }
}
