<?php
namespace OCA\ClubSuiteInventory\Db;

use DateTimeImmutable;

class LoanEntity {
    private ?int $id = null;
    private int $itemId;
    private string $userId;
    private DateTimeImmutable $loanDate;
    private ?DateTimeImmutable $returnDate = null;
    private ?string $status = null;

    public function __construct(int $itemId, string $userId, DateTimeImmutable $loanDate) {
        $this->itemId = $itemId;
        $this->userId = $userId;
        $this->loanDate = $loanDate;
    }

    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }
    public function getItemId(): int { return $this->itemId; }
    public function getUserId(): string { return $this->userId; }
    public function getLoanDate(): DateTimeImmutable { return $this->loanDate; }
    public function getReturnDate(): ?DateTimeImmutable { return $this->returnDate; }
    public function setReturnDate(?DateTimeImmutable $d): void { $this->returnDate = $d; }
    public function getStatus(): ?string { return $this->status; }
    public function setStatus(?string $s): void { $this->status = $s; }
}
