<?php

declare(strict_types=1);

namespace OCA\ClubSuiteInventory\Db;

use OCP\AppFramework\Db\Entity;
use OCP\AppFramework\Db\QBMapper;
use OCP\DB\IDBConnection;

class ItemMapper extends QBMapper {

    public function __construct(IDBConnection $db) {
        parent::__construct($db, 'clubsuite_items', Item::class);
    }

    /**
     * @return Item[]
     */
    public function findAll(): array {
        $qb = $this->db->getQueryBuilder();

        $qb->select('*')
           ->from('clubsuite_items')
           ->orderBy('created_at', 'DESC');

        return $this->findEntities($qb);
    }

    /**
     * @throws \OCP\AppFramework\Db\DoesNotExistException
     * @throws \OCP\AppFramework\Db\MultipleObjectsReturnedException
     */
    public function findById(int $id): Item {
        $qb = $this->db->getQueryBuilder();

        $qb->select('*')
           ->from('clubsuite_items')
           ->where($qb->expr()->eq('id', $qb->createNamedParameter($id)));

        return $this->findEntity($qb);
    }
}
