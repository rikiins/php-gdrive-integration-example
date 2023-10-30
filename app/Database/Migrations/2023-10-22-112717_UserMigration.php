<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 8
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 60
            ],
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
