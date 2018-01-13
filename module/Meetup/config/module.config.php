<?php

declare(strict_types=1);

use Meetup\Form\MeetupForm;
use Meetup\Form\UserForm;
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
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\MeetupController::class => Controller\MeetupControllerFactory::class,
            Controller\UserController::class => Controller\UserControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            MeetupForm::class => InvokableFactory::class,
            UserForm::class => InvokableFactory::class
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
