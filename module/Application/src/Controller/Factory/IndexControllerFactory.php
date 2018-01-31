<?php
/**
 * Created by PhpStorm.
 * User: sms
 * Date: 29.01.18
 * Time: 9:51
 */

namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface {
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new IndexController($container->get('doctrine.entitymanager.orm_default'));
    }
}