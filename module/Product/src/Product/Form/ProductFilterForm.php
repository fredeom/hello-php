<?php
namespace Product\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class ProductFilterForm extends Form {
    public function __construct($name = null) {
        parent::__construct('product-filter');
        $this->setAttribute('method', 'get');
        $this->add(['name' => 'name',     'type' => 'Text',    'options' => ['label' => 'Name'    ]]);
        $this->add(['name' => 'producer', 'type' => 'Text',    'options' => ['label' => 'Producer']]);
        $this->add(['name' => 'type',     'type' => 'Text',    'options' => ['label' => 'Type'    ]]);
        $this->add(['name' => 'pricefrom','type' => 'Number',  'options' => ['label' => 'Price from']]);
        $this->add(['name' => 'priceto',  'type' => 'Number',  'options' => ['label' => 'Price to'  ]]);
        $this->add(['name' => 'datefrom', 'type' => 'DateTimeSelect','options' => ['label' => 'Date from'], 'attributes' => ['value' => new \DateTime("-20 year")]]);
        $this->add(['name' => 'dateto',   'type' => 'DateTimeSelect','options' => ['label' => 'Date to'],   'attributes' => ['value' => new \DateTime("+100 day")]]);
        $this->add(['name' => 'sortby',   'type' => 'Hidden',  'attributes' => ['value' => 'regdate']]);
        $this->add(['name' => 'sortorder','type' => 'Hidden',  'attributes' => ['value' => 'DESC']]);
        $this->add(['name' => 'submit',   'type' => 'Submit',  'attributes' => ['value' => 'Search'] ]);
        $inputFilter = new InputFilter();
        $inputFilter->add(['name' => 'pricefrom', 'required' => false]);
        $inputFilter->add(['name' => 'priceto',   'required' => false]);
        $this->setInputFilter($inputFilter);
    }
}