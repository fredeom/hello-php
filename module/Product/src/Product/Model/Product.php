<?php
namespace Product\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

//class Product implements InputFilterAwareInterface {
//    public $id;
//    public $itemid;
//    public $name;
//    protected $inputFilter;
//    public function exchangeArray ($data = []) {
//        $this->id     = (!empty($data['id'    ])) ? $data['id'    ] : null;
//        $this->itemid = (!empty($data['itemid'])) ? $data['itemid'] : null;
//        $this->name   = (!empty($data['name'  ])) ? $data['name'  ] : null;
//    }
//    public function getArrayCopy() { return get_object_vars($this); }
//    public function setInputFilter(InputFilterInterface $inputFilter) { throw new \Exception("Not used"); }
//    public function getInputFilter() {
//        if (!$this->inputFilter) {
//            $inputFilter = new InputFilter();
//            $inputFilter->add([
//                'name'     => 'id',
//                'required' => true,
//                'filters'  => [
//                    ['name' => 'Int'],
//                ],
//            ]);
//            $inputFilter->add([
//                'name'     => 'itemid',
//                'required' => true,
//                'filters'  => [
//                    ['name' => 'StripTags'],
//                    ['name' => 'StringTrim'],
//                ],
//                'validators' => [
//                    [
//                        'name'    => 'StringLength',
//                        'options' => [
//                            'encoding' => 'UTF-8',
//                            'min'      => 1,
//                            'max'      => 100,
//                        ],
//                    ],
//                ],
//            ]);
//            $inputFilter->add([
//                'name'     => 'name',
//                'required' => true,
//                'filters'  => [
//                    ['name' => 'StripTags'],
//                    ['name' => 'StringTrim'],
//                ],
//                'validators' => [
//                    [
//                        'name'    => 'StringLength',
//                        'options' => [
//                            'encoding' => 'UTF-8',
//                            'min'      => 1,
//                            'max'      => 100,
//                        ],
//                    ],
//                ],
//            ]);
//            $this->inputFilter = $inputFilter;
//        }
//        return $this->inputFilter;
//    }
//}