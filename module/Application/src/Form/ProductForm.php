<?php
namespace Application\Form;

use Zend\Filter\DateTimeSelect;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use DateTime;

class ProductForm extends Form {
    public function __construct() {
        parent::__construct('product-form');
        $this->setAttribute('method', 'post');
        $this->addElements();
        $this->addInputFilter();
    }
    protected function addElements() {
        $this->add(['name' => 'itemid',  'type' => 'text',    'options' => ['label' => 'Item Id'  ]]);
        $this->add(['name' => 'name',    'type' => 'text',    'options' => ['label' => 'Name'     ]]);
        $this->add(['name' => 'producer','type' => 'text',    'options' => ['label' => 'Brand'    ]]);
        $this->add(['name' => 'type',    'type' => 'text',    'options' => ['label' => 'Type'     ]]);
        $this->add(['name' => 'price',   'type' => 'number',  'options' => ['label' => 'Price'    ]]);
        $this->add(['name' => 'discount','type' => 'number',  'options' => ['label' => 'Discount' ]]);
        $this->add(['name' => 'color',   'type' => 'color',   'options' => ['label' => 'Color'    ]]);
        $this->add(['name' => 'regdate', 'type' => 'datetimeselect', 'attributes' => ['value' => new Datetime('now')], 'options' => ['label' => 'Reg.Date']]);
        $this->add(['name' => 'submit',  'type' => 'submit',  'attributes' => ['value' => 'Create']]);
    }
    protected function addInputFilter() {
        $if = new InputFilter();
        $this->setInputFilter($if);
    }
}