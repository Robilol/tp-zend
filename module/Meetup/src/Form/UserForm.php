<?php

declare(strict_types=1);

namespace Meetup\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\Callback;
use Zend\Validator\StringLength;

class UserForm extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('user');

        $this->add([
            'type' => Element\Text::class,
            'name' => 'firstname',
            'options' => [
                'label' => 'Firstname',
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
            'type' => Element\Text::class,
            'name' => 'lastname',
            'options' => [
                'label' => 'Lastname',
            ],
        ]);

        $this->add([
            'type' => Element\Select::class,
            'name' => 'company',
            'options' => [
                'label' => 'Company',
                'value_options' => array(

                ),
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'firstname' => [
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
            'lastname' => [
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
        ];
    }
}
