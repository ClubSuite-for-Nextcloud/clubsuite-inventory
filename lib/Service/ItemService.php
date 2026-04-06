<?php

declare(strict_types=1);

namespace OCA\ClubSuiteInventory\Service;

use DateTimeImmutable;
use Exception;
use OCA\ClubSuiteInventory\Db\Item;
use OCA\ClubSuiteInventory\Db\ItemMapper;
use OCP\AppFramework\Db\DoesNotExistException;

class ItemService {

    public function __construct(
        private ItemMapper $mapper
    ) {}

    public function listItems(): array {
        return $this->mapper->findAll();
    }

    /**
     * @throws DoesNotExistException
     * @throws \OCP\AppFramework\Db\MultipleObjectsReturnedException
     */
    public function getItem(int $id): Item {
        return $this->mapper->findById($id);
    }

    /**
     * @throws Exception
     */
    public function createItem(array $data): Item {
        $this->validate($data);

        $item = new Item();
        $this->hydrate($item, $data);
        
        $now = new DateTimeImmutable();
        $item->setCreatedAt($now);
        $item->setUpdatedAt($now);

        return $this->mapper->insert($item);
    }

    /**
     * @throws DoesNotExistException
     * @throws Exception
     */
    public function updateItem(int $id, array $data): Item {
        $item = $this->mapper->findById($id);
        
        $this->hydrate($item, $data);
        $item->setUpdatedAt(new DateTimeImmutable());

        return $this->mapper->update($item);
    }

    /**
     * @throws DoesNotExistException
     */
    public function deleteItem(int $id): void {
        $item = $this->mapper->findById($id);
        $this->mapper->delete($item);
    }

    private function hydrate(Item $item, array $data): void {
        if (isset($data['name'])) {
            $item->setName($data['name']);
        }
        if (isset($data['description'])) {
            $item->setDescription($data['description']);
        }
        if (isset($data['serialNumber'])) {
            $item->setSerialNumber($data['serialNumber']);
        }
        if (isset($data['acquisitionDate'])) {
            $date = $data['acquisitionDate'] ? new DateTimeImmutable($data['acquisitionDate']) : null;
            $item->setAcquisitionDate($date);
        }
        if (isset($data['value'])) {
            $item->setValue((int)$data['value']);
        }
        if (isset($data['location'])) {
            $item->setLocation($data['location']);
        }
    }

    /**
     * @throws Exception
     */
    private function validate(array $data): void {
        if (empty($data['name'])) {
            throw new Exception('Name is required');
        }
    }
}
