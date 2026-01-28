<?php
namespace OCA\ClubSuiteInventory\Listener;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;

use OCA\ClubSuiteInventory\Events\InventarBasicEvent;

class InventarBasicEventListener implements IEventListener {
    public function handle(Event $event): void {
        if (!($event instanceof InventarBasicEvent)) {
            return;
        }
        error_log('InventarBasicEvent received in Inventar: ' . $event->getId());
    }
}
