<?php
namespace Application\Controller;

use Application\Entity\Product;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\ProductFilterForm;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class IndexController extends AbstractActionController {
    protected $entityManager;
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function indexAction() {
        $form = new ProductFilterForm();
        $filterOptions = array();
        $form->setData($this->params()->fromQuery());
        if ($form->isValid()) {
            foreach ($form->getData() as $key => $value) {
                if (!empty($value)) {
                    $filterOptions[$key] = $value;
                }
            }
        }
        $filters  = implode('&', array_map(function ($v, $k) { return sprintf("%s=%s", $k, $v); }, $filterOptions,array_keys($filterOptions)));
        $page = $this->params()->fromQuery('page', 1);
        $query = $this->entityManager->getRepository(Product::class)->findProducts($filterOptions);
        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(5);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange(15);
        return new ViewModel([
            'form' => $form,
            'products' => $paginator,
            'filters' => $filters
        ]);
    }
}
// $this->entityManager->getRepository(Product::class)->findBy([], ['regdate' => 'DESC'], 10, 0)