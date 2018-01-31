<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
//use Application\Filter\PhoneFilter;
//use Application\Validator\PhoneValidator;

class ProductFilterForm extends Form {
    public function __construct() {
        parent::__construct('product-filter-form');
        $this->setAttribute('method', 'get');
        $this->addElements();
        $this->addInputFilter();
    }

    protected function addElements() {
        $this->add([
            'type' => 'text',
            'name' => 'name',
            'attributes' => [
                'id' => 'name'
            ],
            'options' => [
                'label' => 'Name'
            ]
        ]);
        $this->add([
            'type' => 'text',
            'name' => 'producer',
            'attributes' => [
                'id' => 'producer'
            ],
            'options' => [
                'label' => 'Brand'
            ]
        ]);
        $this->add([
            'type' => 'text',
            'name' => 'type',
            'attributes' => [
                'id' => 'type'
            ],
            'options' => [
                'label' => 'Type'
            ]
        ]);
        $this->add([
            'type' => 'number',
            'name' => 'pricefrom',
            'attributes' => [
                'id' => 'pricefrom'
            ],
            'options' => [
                'label' => 'Price from'
            ]
        ]);
        $this->add([
            'type' => 'number',
            'name' => 'priceto',
            'attributes' => [
                'id' => 'priceto'
            ],
            'options' => [
                'label' => 'Price to'
            ]
        ]);
        $this->add([
            'type' => 'date',
            'name' => 'datefrom',
            'attributes' => [
                'id' => 'datefrom'
            ],
            'options' => [
                'label' => 'Date from'
            ]
        ]);
        $this->add([
            'type' => 'date',
            'name' => 'dateto',
            'attributes' => [
                'id' => 'dateto'
            ],
            'options' => [
                'label' => 'Date to'
            ]
        ]);
        $this->add([
            'type' => 'hidden',
            'name' => 'sortby',
            'attributes' => [
                'value' => 'regdate'
            ]
        ]);
        $this->add([
            'type' => 'hidden',
            'name' => 'sortorder',
            'attributes' => [
                'value' => 'DESC'
            ]
        ]);
        $this->add([
            'type'  => 'submit',
            'name' => 'search',
            'attributes' => [
                'value' => 'Search',
                'id' => 'searchbutton',
            ],
        ]);
    }

    private function addInputFilter() {
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);
        $inputFilter->add([
            'name' => 'name',
            'required' => false,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim']
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 0,
                        'max' => 128
                    ]
                ]
            ]
        ]);
        $inputFilter->add([
            'name' => 'producer',
            'required' => false,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim']
            ]
        ]);
        $inputFilter->add([
            'name' => 'type',
            'required' => false,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim']
            ]
        ]);
        $inputFilter->add([
            'name' => 'pricefrom',
            'required' => false,
        ]);
        $inputFilter->add([
            'name' => 'priceto',
            'required' => false,
        ]);
        $inputFilter->add([
            'name' => 'datefrom',
            'required' => false,
        ]);
        $inputFilter->add([
            'name' => 'dateto',
            'required' => false,
        ]);
    }
}