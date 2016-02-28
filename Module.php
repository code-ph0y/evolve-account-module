<?php

namespace AccountModule;

use PPI\Framework\Autoload;
use PPI\Framework\Module\AbstractModule;

class Module extends AbstractModule
{
    /**
     * Initialize Module
     */
    public function init($e)
    {
        Autoload::add(__NAMESPACE__, dirname(__DIR__));
    }

    /**
     * Get Module Name
     *
     * @return array
     */
    public function getName()
    {
        return 'AccountModule';
    }

    /**
     * Get the routes for this module
     *
     * @return \Symfony\Component\Routing\RouteCollection
     */
    public function getRoutes()
    {
        return $this->loadSymfonyRoutes(__DIR__ . '/resources/routes/symfony.yml');
    }

    /**
     * Get the configuration for this module
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->loadConfig(__DIR__ . '/resources/config/config.php');
    }

    /**
     * Get the Autoloader configuration for this module
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/',
                ),
            ),
        );
    }

    /**
     * Get the Service Config
     *
     */
    public function getServiceConfig()
    {
        return array('factories' => array(
            'account.useraccount.storage' => function ($sm) {
                 return new \AccountModule\Storage\UserAccount($sm->get('datasource')->getConnection('main'));
            }
        ));
    }
}
