<?php
namespace Product;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Product\Model\Product;
use Product\Model\ProductTable;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface {
    public function getAutoloaderConfig() {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }
    public function getConfig() { return include __DIR__ . '/config/module.config.php'; }
//    public function getServiceConfig() {
//        return [
//            'factories' => [
//                'Product\Model\ProductTable' =>  function($sm) {
//                    $tableGateway = $sm->get('ProductTableGateway');
//                    $table = new ProductTable($tableGateway);
//                    return $table;
//                },
//                'ProductTableGateway' => function ($sm) {
//                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
//                    $resultSetPrototype = new ResultSet();
//                    $resultSetPrototype->setArrayObjectPrototype(new Product());
//                    return new TableGateway('product', $dbAdapter, null, $resultSetPrototype);
//                },
//            ],
//        ];
//    }
}
