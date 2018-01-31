<?php
namespace Application\Service;

use Application\Entity\Product;
//use Zend\Filter\StaticFilter;

class ProductManager {
    private $entityManager;
    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }
    private function updateProductWithData($product, $data) {
        $product->setItemId(  $data['itemid'  ]);
        $product->setName(    $data['name'    ]);
        $product->setProducer($data['producer']);
        $product->setType(    $data['type'    ]);
        $product->setPrice(   $data['price'   ]);
        $product->setDiscount($data['discount']);
        $product->setColor(   $data['color'   ]);
        $product->setRegDate( $data['regdate' ]);
    }
    public function addNewProduct($data) {
        $product = new Product();
        $this->updateProductWithData($product, $data);
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }
    public function updateProduct(Product $product, $data) {
        $this->updateProductWithData($product, $data);
        $this->entityManager->flush();
    }
    public function deleteProduct($product) {
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }
}

