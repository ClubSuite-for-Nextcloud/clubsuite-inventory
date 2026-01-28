<?php
namespace OCA\ClubSuiteInventory\Db;

class CategoryEntity {
    private ?int $id = null;
    private string $name;

    public function __construct(string $name) { $this->name = $name; }
    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }
    public function getName(): string { return $this->name; }
    public function setName(string $n): void { $this->name = $n; }
}
