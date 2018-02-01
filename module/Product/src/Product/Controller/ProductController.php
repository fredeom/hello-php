<?php
namespace Product\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;
use Product\Entity\Product;
use Product\Form\ProductForm;
use Product\Form\ProductFilterForm;
use Product\Model\ProductFilter;
use Doctrine\ORM\EntityManager;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator as ZendPaginator;

class ProductController extends AbstractActionController {
    protected $em;
    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }
    public function indexAction() {
        $page = $this->params()->fromQuery("page", 1);
        $form = new ProductFilterForm();
        $form->setData($this->params()->fromQuery());
        $filterArray = [];
        $filter = "";
        $form->isValid();
        foreach ($form->getData() as $k => $v) {
            if (!empty($v)) {
                $filterArray[$k] = $v;
                $filter .= "&" . $k . "=" . $v;
            }
        }
        $query = $this->getEntityManager()->getRepository('Product\Entity\Product')->findProducts($filterArray);
        $adapter = new DoctrinePaginator(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(5);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange(15);
        return new ViewModel([
            'products' => $paginator,
            'form' => $form,
            'filter' => $filter
        ]);
    }
    public function addAction() {
        $form = new ProductForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $product = new Product();
            $form->setInputFilter($product->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $product->exchangeArray($form->getData());
                $this->getEntityManager()->persist($product);
                $this->getEntityManager()->flush();
                return $this->redirect()->toRoute('product');
            }
        }
        return ['form' => $form];
    }
    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('product', ['action' => 'add']);
        }
        $product = $this->getEntityManager()->find('Product\Entity\Product', $id);
        if (!$product) {
            return $this->redirect()->toRoute('product', ['action' => 'index']);
        }
        $form  = new ProductForm();
        $form->bind($product);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($product->getInputFilter());
            var_dump($request->getPost());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getEntityManager()->flush();
                return $this->redirect()->toRoute('product');
            }
        }
        return ['id' => $id, 'form' => $form];
    }
    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('product');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $product = $this->getEntityManager()->find('Product\Entity\Product', $id);
                if ($product) {
                    $this->getEntityManager()->remove($product);
                    $this->getEntityManager()->flush();
                }
            }
            return $this->redirect()->toRoute('product');
        }
        return [
            'id' => $id,
            'product' => $this->getEntityManager()->find('Product\Entity\Product', $id)
        ];
    }
}