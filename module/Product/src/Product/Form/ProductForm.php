<?php
namespace Product\Form;

use Zend\Form\Form;

class ProductForm extends Form {
    public function __construct($name = null) {
        parent::__construct('product');
        $this->setAttribute('method', 'post');
        $this->add(['name' => 'id',       'type' => 'Hidden']);
        $this->add(['name' => 'itemid',   'type' => 'Text',    'options' => ['label' => 'Item Id' ]]);
        $this->add(['name' => 'name',     'type' => 'Text',    'options' => ['label' => 'Name'    ]]);
        $this->add(['name' => 'producer', 'type' => 'Text',    'options' => ['label' => 'Producer']]);
        $this->add(['name' => 'type',     'type' => 'Text',    'options' => ['label' => 'Type'    ]]);
        $this->add(['name' => 'color',    'type' => 'Color',   'options' => ['label' => 'Color'   ]]);
        $this->add(['name' => 'price',    'type' => 'Number',  'options' => ['label' => 'Price'   ]]);
        $this->add(['name' => 'discount', 'type' => 'Number' /*'\Product\Form\Element\Number'*/,  'options' => ['label' => 'Discount']]);
        $this->add(['name' => 'regdate',  'type' => 'DateTimeSelect','options' => ['label' => 'Reg.Date'], 'attributes' => ['value' => new \DateTime("now")]]);
        $this->add(['name' => 'submit',   'type' => 'Submit',  'attributes' => ['value' => 'Go'] ]);
    }
}