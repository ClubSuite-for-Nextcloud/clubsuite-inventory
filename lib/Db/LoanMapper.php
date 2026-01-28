<?php
namespace OCA\ClubSuiteInventory\Db;

use DateTime;

class LoanMapper {
    private $connection;

    public function __construct($connection) { $this->connection = $connection; }

    public function findAll(): array {
        $sql = 'SELECT * FROM `*PREFIX*inventar_loan` ORDER BY `loan_date` DESC';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $res = [];
        while ($row = $stmt->fetch()) {
            $l = new LoanEntity((int)$row['item_id'], $row['user_id'], new DateTime($row['loan_date']));
            $l->setId((int)$row['id']);
            $l->setReturnDate(!empty($row['return_date']) ? new DateTime($row['return_date']) : null);
            $l->setStatus($row['status'] ?? null);
            $res[] = $l;
        }
        return $res;
    }

    public function findById(int $id): ?LoanEntity {
        $sql = 'SELECT * FROM `*PREFIX*inventar_loan` WHERE `id` = ? LIMIT 1';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if (!$row) return null;
        $l = new LoanEntity((int)$row['item_id'], $row['user_id'], new DateTime($row['loan_date']));
        $l->setId((int)$row['id']);
        $l->setReturnDate(!empty($row['return_date']) ? new DateTime($row['return_date']) : null);
        $l->setStatus($row['status'] ?? null);
        return $l;
    }

    public function create(LoanEntity $l): int {
        $sql = 'INSERT INTO `*PREFIX*inventar_loan` (`item_id`,`user_id`,`loan_date`,`return_date`,`status`) VALUES (?,?,?,?,?)';
        $this->connection->prepare($sql)->execute([
            $l->getItemId(), $l->getUserId(), $l->getLoanDate()->format('Y-m-d H:i:s'), $l->getReturnDate()?->format('Y-m-d H:i:s'), $l->getStatus()
        ]);
        return (int)$this->connection->lastInsertId();
    }

    public function update(LoanEntity $l): void {
        $sql = 'UPDATE `*PREFIX*inventar_loan` SET `return_date` = ?, `status` = ? WHERE `id` = ?';
        $this->connection->prepare($sql)->execute([
            $l->getReturnDate()?->format('Y-m-d H:i:s'), $l->getStatus(), $l->getId()
        ]);
    }

    public function delete(int $id): void {
        $sql = 'DELETE FROM `*PREFIX*inventar_loan` WHERE `id` = ?';
        $this->connection->prepare($sql)->execute([$id]);
    }
}
