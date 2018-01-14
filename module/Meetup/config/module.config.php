<?php

declare(strict_types=1);

use Meetup\Form\MeetupForm;
use Meetup\Form\UserForm;
use Meetup\Form\CompanyForm;
use Zend\Router\Http\Literal;
use Meetup\Controller;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'meetup' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/meetup',
                    'defaults' => [
                        'controller' => Controller\MeetupController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/add',
                            'defaults' => [
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => 'segment',
                        'options' => [
                            'route'    => '/delete/:id',
                            'defaults' => [
                                'action'     => 'delete',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ]
                        ],
                    ],
                    'edit' => [
                        'type' => 'segment',
                        'options' => [
                            'route'    => '/edit/:id',
                            'defaults' => [
                                'action'     => 'edit',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ]
                        ],
                    ],
                    'show' => [
                        'type' => 'segment',
                        'options' => [
                            'route'    => '/show/:id',
                            'defaults' => [
                                'action'     => 'show',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ]
                        ],
                    ],
                ],
            ],
            'user' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/user',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/add',
                            'defaults' => [
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => 'segment',
                        'options' => [
                            'route'    => '/delete/:id',
                            'defaults' => [
                                'action'     => 'delete',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ]
                        ],
                    ],
                    'edit' => [
                        'type' => 'segment',
                        'options' => [
                            'route'    => '/edit/:id',
                            'defaults' => [
                                'action'     => 'edit',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ]
                        ],
                    ],
                    'show' => [
                        'type' => 'segment',
                        'options' => [
                            'route'    => '/show/:id',
                            'defaults' => [
                                'action'     => 'show',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ]
                        ],
                    ],
                ],
            ],
            'company' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/company',
                    'defaults' => [
                        'controller' => Controller\CompanyController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/add',
                            'defaults' => [
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => 'segment',
                        'options' => [
                            'route'    => '/delete/:id',
                            'defaults' => [
                                'action'     => 'delete',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ]
                        ],
                    ],
                    'edit' => [
                        'type' => 'segment',
                        'options' => [
                            'route'    => '/edit/:id',
                            'defaults' => [
                                'action'     => 'edit',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ]
                        ],
                    ],
                    'show' => [
                        'type' => 'segment',
                        'options' => [
                            'route'    => '/show/:id',
                            'defaults' => [
                                'action'     => 'show',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ]
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\MeetupController::class => Controller\MeetupControllerFactory::class,
            Controller\UserController::class => Controller\UserControllerFactory::class,
            Controller\CompanyController::class => Controller\CompanyControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            MeetupForm::class => InvokableFactory::class,
            CompanyForm::class => InvokableFactory::class
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'meetup/meetup/index' => __DIR__ . '/../view/meetup/index.phtml',
            'meetup/meetup/add' => __DIR__ . '/../view/meetup/add.phtml',
            'meetup/meetup/edit' => __DIR__ . '/../view/meetup/edit.phtml',
            'meetup/meetup/show' => __DIR__ . '/../view/meetup/detail.phtml',
            'meetup/user/index' => __DIR__ . '/../view/user/index.phtml',
            'meetup/user/add' => __DIR__ . '/../view/user/add.phtml',
            'meetup/user/edit' => __DIR__ . '/../view/user/edit.phtml',
            'meetup/user/show' => __DIR__ . '/../view/user/detail.phtml',
            'meetup/company/index' => __DIR__ . '/../view/company/index.phtml',
            'meetup/company/add' => __DIR__ . '/../view/company/add.phtml',
            'meetup/company/edit' => __DIR__ . '/../view/company/edit.phtml',
            'meetup/company/show' => __DIR__ . '/../view/company/detail.phtml',
        ],
    ],
    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'meetup_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/Entity/',
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register `application_driver` for any entity under namespace `Application\Entity`
                    'Meetup\Entity' => 'meetup_driver',
                ],
            ],
        ],
    ],
];
