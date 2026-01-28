<?php
namespace OCA\ClubSuiteInventory\Listener;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;

use OCA\ClubSuiteInventory\Events\InventarCallbackEvent;

class InventarCallbackEventListener implements IEventListener {
    public function handle(Event $event): void {
        if (!($event instanceof InventarCallbackEvent)) {
            return;
        }
        $payload = $event->getPayload();
        $event->triggerCallback(['handledBy' => 'Inventar', 'items' => count($payload)]);
    }
}
