<?php
namespace OCA\ClubSuiteInventory\Job;

use OCP\BackgroundJob\TimedJob;

class InventoryStatsJob extends TimedJob {
    public function __construct() {
        parent::__construct();
    }

    public function run($argument) {
        // placeholder: compute aggregates, warm cache, etc.
    }
}
