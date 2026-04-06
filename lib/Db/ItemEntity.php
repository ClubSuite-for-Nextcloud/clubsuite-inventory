<?php
namespace OCA\ClubSuiteInventory\Db;

use DateTimeImmutable;

class ItemEntity {
    private ?int $id = null;
    private string $name;
    private ?string $description = null;
    private ?int $categoryId = null;
    private ?string $qrCode = null;
    private ?DateTimeImmutable $createdAt = null;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }
    public function getName(): string { return $this->name; }
    public function setName(string $n): void { $this->name = $n; }
    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $d): void { $this->description = $d; }
    public function getCategoryId(): ?int { return $this->categoryId; }
    public function setCategoryId(?int $id): void { $this->categoryId = $id; }
    public function getQrCode(): ?string { return $this->qrCode; }
    public function setQrCode(?string $q): void { $this->qrCode = $q; }
    public function getCreatedAt(): ?DateTimeImmutable { return $this->createdAt; }
    public function setCreatedAt(?DateTimeImmutable $dt): void { $this->createdAt = $dt; }
}
