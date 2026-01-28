<?php
namespace OCA\ClubSuiteInventory\Service;

use OCP\ICache;

class CacheService {
    /** @var ICache */
    private $cache;

    public function __construct(ICache $cache) {
        $this->cache = $cache;
    }

    public function get(string $key) {
        return $this->cache->get($key);
    }

    public function set(string $key, $value, int $ttl = 300) {
        $this->cache->set($key, $value, $ttl);
    }

    public function delete(string $key) {
        $this->cache->delete($key);
    }
}
