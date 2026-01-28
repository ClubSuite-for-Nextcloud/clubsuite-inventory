<?php
namespace OCA\ClubSuiteInventory\Migrations;

use OCP\AppFramework\Db\SchemaTrait;
use OCP\Migration\IMigration;
use OCP\Migration\IOutput;

class Version20260105_AddIndexes implements IMigration {
    use SchemaTrait;

    public function changeSchema(IOutput $output) {
        $schema = $this->getSchema();
        if ($schema->hasTable('inventar_item')) {
            $t = $schema->getTable('inventar_item');
            if (!$t->hasIndex('idx_inventar_item_category')) {
                $t->addIndex(['category_id'], 'idx_inventar_item_category');
            }
            if (!$t->hasIndex('idx_inventar_item_created')) {
                $t->addIndex(['created_at'], 'idx_inventar_item_created');
            }
            if (!$t->hasIndex('idx_inventar_item_qr')) {
                $t->addIndex(['qr_code'], 'idx_inventar_item_qr');
            }
        }
    }

    public function up(IOutput $output) {
        $this->changeSchema($output);
    }

    public function down(IOutput $output) {
        // no-op for now
    }
}
