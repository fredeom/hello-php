<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\ProductForm;
use Application\Entity\Product;


class ProductController extends AbstractActionController {
    private $entityManager;
    private $productManager;
    public function __construct($entityManager, $productManager) {
        $this->entityManager = $entityManager;
        $this->productManager = $productManager;
    }
    public function addAction() {
        $form = new ProductForm();
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->productManager->addNewProduct($data);
                return $this->redirect()->toRoute('home');
            }
        }
        return new ViewModel(['form' => $form]);
    }
    public function editAction() {
        $form = new ProductForm();
        $productid = $this->params()->fromRoute('id', -1);
        $product = $this->entityManager->getRepository(Product::class)->findOneById($productid);
        if ($product == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->productManager->updateProduct($product, $data);
                return $this->redirect()->toRoute('product');
            }
        } else {
            $data = [
                'itemid'   => $product->getItemId(),
                'name'     => $product->getName(),
                'producer' => $product->getProducer(),
                'type'     => $product->getType(),
                'price'    => $product->getPrice(),
                'discount' => $product->getDiscount(),
                'color'    => $product->getColor(),
                'regdate'  => $product->getRegDate(),
            ];
            $form->setData($data);
        }
        return new ViewModel([
            'form' => $form,
            "product" => $product
        ]);
    }
    public function deleteAction() {
        $productid = $this->params()->fromRoute('id', -1);
        $product = $this->entityManager->getRepository(Product::class)->findOneById($productid);
        if ($product == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $this->productManager->deleteProduct($product);
        return $this->redirect()->toRoute('home', [], ['query' => $this->params()->fromQuery()]);
    }
    public function indexAction() {
        return $this->redirect()->toRoute("home");
    }
}
