<?php
namespace OCA\ClubSuiteInventory\Db;

class CategoryMapper {
    private $connection;

    public function __construct($connection) { $this->connection = $connection; }

    public function findAll(): array {
        $sql = 'SELECT * FROM `*PREFIX*inventar_category` ORDER BY `name` ASC';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $res = [];
        while ($row = $stmt->fetch()) {
            $c = new CategoryEntity($row['name']);
            $c->setId((int)$row['id']);
            $res[] = $c;
        }
        return $res;
    }

    public function findById(int $id): ?CategoryEntity {
        $sql = 'SELECT * FROM `*PREFIX*inventar_category` WHERE `id` = ? LIMIT 1';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if (!$row) return null;
        $c = new CategoryEntity($row['name']);
        $c->setId((int)$row['id']);
        return $c;
    }

    public function create(CategoryEntity $c): int {
        $sql = 'INSERT INTO `*PREFIX*inventar_category` (`name`) VALUES (?)';
        $this->connection->prepare($sql)->execute([$c->getName()]);
        return (int)$this->connection->lastInsertId();
    }

    public function update(CategoryEntity $c): void {
        $sql = 'UPDATE `*PREFIX*inventar_category` SET `name` = ? WHERE `id` = ?';
        $this->connection->prepare($sql)->execute([$c->getName(), $c->getId()]);
    }

    public function delete(int $id): void {
        $sql = 'DELETE FROM `*PREFIX*inventar_category` WHERE `id` = ?';
        $this->connection->prepare($sql)->execute([$id]);
    }
}
