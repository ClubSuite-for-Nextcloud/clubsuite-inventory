<?php

declare(strict_types=1);

namespace OCA\ClubSuiteInventory\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\SimpleMigrationStep;
use OCP\Migration\IOutput;

class Version000101Date20260116 extends SimpleMigrationStep {

    public function changeSchema(IOutput $output, Closure $schemaClosure, array $options): ?ISchemaWrapper {
        $schema = $schemaClosure();

        if (!$schema->hasTable('clubsuite_items')) {
            $table = $schema->createTable('clubsuite_items');

            $table->addColumn('id', 'integer', [
                'autoincrement' => true,
                'notnull' => true,
            ]);
            $table->addColumn('name', 'string', [
                'notnull' => true,
                'length' => 150,
            ]);
            $table->addColumn('description', 'text', [
                'notnull' => false,
            ]);
            $table->addColumn('serial_number', 'string', [
                'notnull' => false,
                'length' => 100,
            ]);
            $table->addColumn('acquisition_date', 'date', [
                'notnull' => false,
            ]);
            // Value in cents
            $table->addColumn('value', 'integer', [
                'notnull' => false,
                'default' => 0,
            ]);
            $table->addColumn('location', 'string', [
                'notnull' => false,
                'length' => 150,
            ]);
            $table->addColumn('created_at', 'datetime', [
                'notnull' => true,
            ]);
            $table->addColumn('updated_at', 'datetime', [
                'notnull' => true,
            ]);

            $table->setPrimaryKey(['id']);
            $table->addIndex(['name'], 'idx_cs_inv_name');
        }

        return $schema;
    }
}
