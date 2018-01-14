<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Doctrine\ORM\EntityManager;
use Meetup\Entity\Company;
use Meetup\Form\CompanyForm;
use Psr\Container\ContainerInterface;

final class CompanyControllerFactory
{
    public function __invoke(ContainerInterface $container) : CompanyController
    {
        $companyRepository = $container->get(EntityManager::class)->getRepository(Company::class);
        $companyForm = $container->get(CompanyForm::class);

        return new CompanyController($companyRepository, $companyForm);
    }
}
