<?php
namespace Product\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * @ORM\Entity(repositoryClass="\Product\Repository\ProductRepository")
 * @ORM\Table(name="product", uniqueConstraints={@ORM\UniqueConstraint(name="itemid", columns={"itemid"})})
 */
class Product implements InputFilterAwareInterface {
    protected $inputFilter;
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    /**
     * @ORM\Column(name="itemid", type="string", length=30, nullable=false)
     */
    protected $itemid;
    /**
     * @ORM\Column(name="name", type="string", length=30, nullable=false)
     */
    protected $name;
    /**
     * @ORM\Column(name="producer", type="string", length=30, nullable=false)
     */
    protected $producer;
    /**
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     */
    protected $type;
    /**
     * @ORM\Column(name="color", type="string", length=30, nullable=false)
     */
    protected $color;
    /**
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    protected $price;
    /**
     * @ORM\Column(name="discount", type="integer", nullable=true)
     */
    protected $discount;
    /**
     * @ORM\Column(name="regdate", type="datetime", nullable=false)
     */
    protected $regdate;

    public function __get($property) {
        return $this->$property;
    }
    public function __set($property, $value) {
        $this->$property = $value;
    }
    public function getArrayCopy() {
        return get_object_vars($this);
    }
    public function exchangeArray ($data = []) {
        $this->id       = (int)$data['id'      ];
        $this->itemid   =      $data['itemid'  ];
        $this->name     =      $data['name'    ];
        $this->producer =      $data['producer'];
        $this->type     =      $data['type'    ];
        $this->color    =      $data['color'   ];
        $this->price    = (int)$data['price'   ];
        $this->discount = (int)$data['discount'];
        $this->regdate  = new \DateTime($data['regdate' ]);
    }
    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }
    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $inputFilter->add([
                'name'     => 'id',
                'required' => false,
                'filters'  => [
                    ['name' => 'Int'],
                ],
            ]);
            $inputFilter->add([
                'name'     => 'itemid',
                'required' => true,
                'filters'  => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ],
                    ],
                ],
            ]);
            $inputFilter->add([
                'name'     => 'name',
                'required' => true,
                'filters'  => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ],
                    ],
                ],
            ]);
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}