<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAutaTables extends Migration
{
    public function up()
    {
        // Tabulka znacka_auta
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'znacka' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('znacka_auta');

        // Tabulka model_auta
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'znacka_auta_id' => ['type' => 'INT', 'null' => false],
            'model' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'palivo' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => false],
            'obrazek' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'popis' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('znacka_auta_id', 'znacka_auta', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('model_auta');

        // Tabulka typ_auta
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'typ' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('typ_auta');

        // Tabulka relace typ_auta_has_model_auta (m:n)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'typ_auta_id' => ['type' => 'INT', 'null' => false],
            'model_auta_id' => ['type' => 'INT', 'null' => false],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true], // přidáno pro softdelete
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('typ_auta_id', 'typ_auta', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('model_auta_id', 'model_auta', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('typ_auta_has_model_auta');

        // Tabulka uzivatel (pro ukázku, pokud není)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('uzivatel');
    }

    public function down()
    {
        $this->forge->dropTable('typ_auta_has_model_auta');
        $this->forge->dropTable('model_auta');
        $this->forge->dropTable('znacka_auta');
        $this->forge->dropTable('typ_auta');
        $this->forge->dropTable('uzivatel');
    }
}
