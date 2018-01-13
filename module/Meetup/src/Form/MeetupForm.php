<?php

declare(strict_types=1);

namespace Meetup\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\Callback;
use Zend\Validator\StringLength;

class MeetupForm extends Form implements InputFilterProviderInterface
{
    public function __construct($users, $companies)
    {

        $optionsCompany = [];

        foreach ($companies as $company) /* @var $company \Meetup\Entity\Company */
        {
            $optionsCompany[$company->getId()] = $company->getName();
        }

        $optionsUser = [];

        foreach ($users as $user) /* @var $user \Meetup\Entity\User */
        {
            $optionsUser[$user->getId()] = $user->getFirstname()." ".$user->getLastname();
        }

        parent::__construct('meetup');

        $this->add([
            'type' => Element\Text::class,
            'name' => 'title',
            'options' => [
                'label' => 'Title',
            ],
        ]);

        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Submit',
            ],
        ]);

        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'description',
            'options' => [
                'label' => 'Description',
            ],
        ]);

        $this->add([
            'type' => Element\Date::class,
            'name' => 'stime',
            'options' => [
                'label' => 'Start date',
            ],
        ]);

        $this->add([
            'type' => Element\Date::class,
            'name' => 'etime',
            'options' => [
                'label' => 'End date',
            ],
        ]);

        $this->add([
            'type' => Element\Select::class,
            'name' => 'creator',
            'options' => [
                'label' => 'Creator',
                'value_options' => $optionsUser
            ],
        ]);

        $this->add([
            'type' => Element\Select::class,
            'name' => 'company',
            'options' => [
                'label' => 'Company',
                'value_options' => $optionsCompany
            ],
        ]);

        $this->add([
            'type' => Element\Select::class,
            'name' => 'participants',
            'attributes' => array(
                'multiple' => 'multiple',
            ),
            'options' => [
                'label' => 'Participants',
                'value_options' => $optionsUser
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'title' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 15,
                        ],
                    ],
                ],
            ],
            'description' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 80,
                        ],
                    ],
                ],
            ],
            'stime' => [
                'validators' => [
                    [
                        'name' => 'Callback',
                        'options' => [
                            'messages' => array(Callback::INVALID_VALUE => 'Start time must be before end time*'),
                            'callback' => function ($value, $context = []) {
                                if ($value > $context['etime']) {
                                    return false;
                                }
                                return true;
                            },
                        ],
                    ],
                ],
            ],
            'etime' => [
                'validators' => [
                    [
                        'name' => 'Callback',
                        'options' => [
                            'messages' => array(Callback::INVALID_VALUE => 'End time must be after start time*'),
                            'callback' => function ($value, $context = []) {
                                if ($value < $context['stime']) {
                                    return false;
                                }
                                return true;
                            },
                        ],
                    ],
                ],
            ],
        ];
    }
}
