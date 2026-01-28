<?php
namespace OCA\ClubSuiteInventory\Service;

use OCP\EventDispatcher\IEventDispatcher;
use OCA\ClubSuiteInventory\Events\InventarBasicEvent;
use OCA\ClubSuiteInventory\Events\InventarCallbackEvent;
use OCA\ClubSuiteInventory\Events\InventarRequestDataEvent;

class EventService {
    private IEventDispatcher $dispatcher;

    public function __construct(IEventDispatcher $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function dispatchBasicEvent(array $payload): void {
        $event = new InventarBasicEvent(uniqid('inv_', true), time(), $payload);
        $this->dispatcher->dispatch($event);
    }

    public function dispatchCallbackEvent(array $payload, callable $callback): void {
        $event = new InventarCallbackEvent(uniqid('inv_cb_', true), time(), $payload, $callback);
        $this->dispatcher->dispatch($event);
    }

    public function dispatchRequestDataEvent(callable $callback): void {
        $event = new InventarRequestDataEvent(uniqid('inv_req_', true), time(), [], $callback);
        $this->dispatcher->dispatch($event);
    }
}
