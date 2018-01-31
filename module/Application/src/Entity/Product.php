<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="\Application\Repository\ProductRepository")
 * @ORM\Table(name="product")
 */
class Product {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;
    /**
     * @ORM\Column(name="itemid")
     */
    protected $itemid;
    /**
     * @ORM\Column(name="name")
     */
    protected $name;
    /**
     * @ORM\Column(name="producer")
     */
    protected $producer;
    /**
     * @ORM\Column(name="type")
     */
    protected $type;
    /**
     * @ORM\Column(name="color")
     */
    protected $color;
    /**
     * @ORM\Column(name="price")
     */
    protected $price;
    /**
     * @ORM\Column(name="discount")
     */
    protected $discount;
    /**
     * 'reg_date' should replace 'regdata'
     * @ORM\Column(name="regdate")
     */
    protected $regdate;

    public function getId() { return $this->id; } public function setId($id) { $this->id = $id; }
    public function getItemId() { return $this->itemid; } public function setItemId($itemid) { $this->itemid = $itemid; }
    public function getName() { return $this->name; } public function setName($name) { $this->name = $name; }
    public function getProducer() { return $this->producer; } public function setProducer($producer) { $this->producer = $producer; }
    public function getType() { return $this->type; } public function setType($type) { $this->type = $type; }
    public function getColor() { return $this->color; } public function setColor($color) { $this->color = $color; }
    public function getPrice() { return $this->price; } public function setPrice($price) { $this->price = $price; }
    public function getDiscount() { return $this->discount; } public function setDiscount($discount) { $this->discount = $discount; }
    public function getRegDate() { return $this->regdate; } public function setRegDate($regdate) { $this->regdate = $regdate; }
}