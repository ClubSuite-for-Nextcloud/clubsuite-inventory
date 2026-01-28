<?php
namespace OCA\ClubSuiteInventory\Migrations;

use Doctrine\DBAL\Schema\Schema;
use OCP\Migration\IChange;

class Version20260104 implements IChange {
    public function changeSchema(Schema $schema): void {
        if (!$schema->hasTable('inventar_item')) {
            $table = $schema->createTable('inventar_item');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('name', 'string', ['length' => 255]);
            $table->addColumn('description', 'text', ['notnull' => false]);
            $table->addColumn('category_id', 'integer', ['notnull' => false]);
            $table->addColumn('qr_code', 'string', ['length' => 255, 'notnull' => false]);
            $table->addColumn('created_at', 'datetime', ['notnull' => false]);
            $table->setPrimaryKey(['id']);
        }

        if (!$schema->hasTable('inventar_category')) {
            $table = $schema->createTable('inventar_category');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('name', 'string', ['length' => 255]);
            $table->setPrimaryKey(['id']);
        }

        if (!$schema->hasTable('inventar_loan')) {
            $table = $schema->createTable('inventar_loan');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('item_id', 'integer');
            $table->addColumn('user_id', 'string', ['length' => 64]);
            $table->addColumn('loan_date', 'datetime');
            $table->addColumn('return_date', 'datetime', ['notnull' => false]);
            $table->addColumn('status', 'string', ['length' => 32, 'notnull' => false]);
            $table->setPrimaryKey(['id']);
        }
    }

    public function getComment(): string {
        return 'Create inventar tables';
    }
}
