<?php

declare(strict_types=1);

namespace OCA\ClubSuiteInventory\Db;

use DateTimeImmutable;
use JsonSerializable;
use OCP\AppFramework\Db\Entity;

class Item extends Entity implements JsonSerializable {

    protected string $name;
    protected ?string $description = null;
    protected ?string $serialNumber = null;
    protected ?DateTimeImmutable $acquisitionDate = null;
    protected ?int $value = 0;
    protected ?string $location = null;
    protected ?DateTimeImmutable $createdAt = null;
    protected ?DateTimeImmutable $updatedAt = null;

    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'serialNumber' => $this->serialNumber,
            'acquisitionDate' => $this->acquisitionDate ? $this->acquisitionDate->format('Y-m-d') : null,
            'value' => $this->value,
            'location' => $this->location,
            'createdAt' => $this->createdAt ? $this->createdAt->format(DateTimeImmutable::ATOM) : null,
            'updatedAt' => $this->updatedAt ? $this->updatedAt->format(DateTimeImmutable::ATOM) : null,
        ];
    }
}
