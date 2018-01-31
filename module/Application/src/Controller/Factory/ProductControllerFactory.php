<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Service\ProductManager;
use Application\Controller\ProductController;

class ProductControllerFactory implements FactoryInterface {
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new ProductController(
            $container->get('doctrine.entitymanager.orm_default'), // ???
            $container->get(ProductManager::class)
        );
    }
}