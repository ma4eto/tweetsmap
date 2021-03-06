<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\EventManager\EventInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature;

class Module implements Feature\BootstrapListenerInterface, Feature\ConfigProviderInterface,
                        Feature\AutoloaderProviderInterface, Feature\ViewHelperProviderInterface,
                        Feature\FormElementProviderInterface, Feature\ServiceProviderInterface
{

    /**
     * @param EventInterface|MvcEvent $e
     *
     * @return array|void
     */
    public function onBootstrap(EventInterface $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $authListener = $e->getApplication()->getServiceManager()->get('app.auth.listener');
        $authListener->attach($eventManager);
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getViewHelperConfig()
    {
        return [
            'aliases'   => [
                'googleMapsScript' => 'Application\\View\\Helper\\GoogleMapsScript',
            ],
            'factories' => [
                'Application\\View\\Helper\\GoogleMapsScript' => 'Application\\View\\Factory\\Helper\\GoogleMapsScriptFactory',
            ]
        ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getFormElementConfig()
    {
        return [
            'invokables' => [
                'tweets.form.search' => 'Application\\Form\\SearchForm',
            ]
        ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
            'aliases'   => [
                'app.auth.storage'            => 'Application\\Auth\\AuthenticationStorage',
                'app.auth.listener'           => 'Application\\Auth\\AuthenticationListener',
                'app.service.history-tracker' => 'Application\\Service\\HistoryTracker',
                'twitter.client'              => 'Application\\Twitter\\Client',
                'twitter.auth.token-storage'  => 'Application\\Twitter\\Auth\\DoctrineORMTokenStorage',
                'twitter.auth.auth-provider'  => 'Application\\Twitter\\Auth\\AppAuthProvider',
                'twitter.api.search'          => 'Application\\Twitter\\Api\\Search\\SearchCacheApi',
                'twitter.api.search.params'   => 'Application\\Twitter\\Api\\Search\\SearchApiParams',
            ],
            'factories' => [
                'Application\\Auth\\AuthenticationStorage'            => 'Application\\Auth\\Factory\\AuthenticationStorageFactory',
                'Application\\Auth\\AuthenticationListener'           => 'Application\\Auth\\Factory\\AuthenticationListenerFactory',
                'Application\\Service\\HistoryTracker'                => 'Application\\Service\\Factory\\HistoryTrackerFactory',
                'Application\\Twitter\\Client'                        => 'Application\\Twitter\\Factory\\ClientFactory',
                'Application\\Twitter\\Auth\\DoctrineORMTokenStorage' => 'Application\\Twitter\\Factory\\Auth\\DoctrineORMTokenStorageFactory',
                'Application\\Twitter\\Auth\\AppAuthProvider'         => 'Application\\Twitter\\Factory\\Auth\\AppAuthProviderFactory',
                'Application\\Twitter\\Api\\Search\\SearchApi'        => 'Application\\Twitter\\Factory\\Api\\SearchApiFactory',
                'Application\\Twitter\\Api\\Search\\SearchCacheApi'   => 'Application\\Twitter\\Factory\\Api\\SearchCacheApiFactory',
                'Application\\Twitter\\Api\\Search\\SearchApiParams'  => 'Application\\Twitter\\Factory\\Api\\SearchApiParamsFactory',
            ],
            'shared'    => [
                'Application\\Twitter\\Api\\Search\\SearchApiParams' => false
            ]
        ];
    }
}
