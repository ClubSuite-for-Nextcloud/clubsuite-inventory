<?php
namespace OCA\ClubSuiteInventory\Service;

use OCA\ClubSuiteInventory\Db\LoanMapper;
use OCA\ClubSuiteInventory\Db\LoanEntity;

class LoanService {
    private LoanMapper $mapper;

    public function __construct(LoanMapper $mapper) { $this->mapper = $mapper; }

    public function listLoans(): array { return $this->mapper->findAll(); }
    public function getLoan(int $id): ?LoanEntity { return $this->mapper->findById($id); }
    public function createLoan(LoanEntity $l): int { return $this->mapper->create($l); }
    public function updateLoan(LoanEntity $l): void { $this->mapper->update($l); }
    public function deleteLoan(int $id): void { $this->mapper->delete($id); }
}
