<?php
namespace OCA\ClubSuiteInventory\Listener;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;

use OCA\ClubSuiteInventory\Events\InventarRequestDataEvent;

class InventarRequestDataEventListener implements IEventListener {
    public function handle(Event $event): void {
        if (!($event instanceof InventarRequestDataEvent)) {
            return;
        }
        $data = ['app' => 'Inventar', 'count' => 0];
        $event->respond($data);
    }
}
