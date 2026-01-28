<?php
declare(strict_types=1);

namespace OCA\ClubSuiteInventory\AppInfo;

use OCA\ClubSuiteInventory\Privacy\Register;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\IContainer;
use OCA\ClubSuiteInventory\Db\ItemMapper;
use OCA\ClubSuiteInventory\Service\ItemService;
use OCA\ClubSuiteInventory\Service\CacheService;
use OCA\ClubSuiteInventory\Service\EventService;
use OCA\ClubSuiteInventory\Listener\InventarBasicEventListener;
use OCA\ClubSuiteInventory\Listener\InventarCallbackEventListener;
use OCA\ClubSuiteInventory\Listener\InventarRequestDataEventListener;
use OCA\ClubSuiteInventory\Events\InventarBasicEvent;
use OCA\ClubSuiteInventory\Events\InventarCallbackEvent;
use OCA\ClubSuiteInventory\Events\InventarRequestDataEvent;

if (!\class_exists('OCA\ClubSuiteInventory\AppInfo\Application', false)) {
class Application extends App implements IBootstrap {
    public const APP_ID = 'clubsuite-inventory';

    public function __construct(array $urlParams = []) {
        parent::__construct(self::APP_ID, $urlParams);
        $container = $this->getContainer();
        $container->registerService('ItemMapper', function(IContainer $c){ return new ItemMapper($c->query('DatabaseConnection')); });
        $container->registerService('CacheService', function(IContainer $c){ return new CacheService($c->query('ICache')); });
        $container->registerService('ItemService', function(IContainer $c){ return new ItemService($c->query('ItemMapper')); });
        $container->registerService('EventService', function(IContainer $c){ return new EventService(\OC::$server->getEventDispatcher()); });
    }

    public function register(IRegistrationContext $context): void {
        $context->registerEventListener(InventarBasicEvent::class, InventarBasicEventListener::class);
        $context->registerEventListener(InventarCallbackEvent::class, InventarCallbackEventListener::class);
        $context->registerEventListener(InventarRequestDataEvent::class, InventarRequestDataEventListener::class);
    }

    public function boot(IBootContext $context): void {
        $context->injectFn(function(\OCP\IContainer $c) {
            if (\interface_exists('\OCP\Privacy\IManager')) {
                $c->get(\OCP\Privacy\IManager::class)->registerProvider(Register::class);
            }
        });
    }
}

}
