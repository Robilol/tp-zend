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
    public function __construct()
    {
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
