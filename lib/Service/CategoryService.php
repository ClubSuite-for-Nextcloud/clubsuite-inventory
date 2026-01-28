<?php
namespace OCA\ClubSuiteInventory\Service;

use OCA\ClubSuiteInventory\Db\CategoryMapper;
use OCA\ClubSuiteInventory\Db\CategoryEntity;

class CategoryService {
    private CategoryMapper $mapper;

    public function __construct(CategoryMapper $mapper) { $this->mapper = $mapper; }

    public function listCategories(): array { return $this->mapper->findAll(); }
    public function getCategory(int $id): ?CategoryEntity { return $this->mapper->findById($id); }
    public function createCategory(CategoryEntity $c): int { return $this->mapper->create($c); }
    public function updateCategory(CategoryEntity $c): void { $this->mapper->update($c); }
    public function deleteCategory(int $id): void { $this->mapper->delete($id); }
}
