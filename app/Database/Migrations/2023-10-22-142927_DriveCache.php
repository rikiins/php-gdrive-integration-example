<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DriveCache extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'file_id' => [
                'type' => 'VARCHAR',
                'constraint' => 33
            ],
            'file_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'file_size' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'mime_type' => [
                'type' => 'VARCHAR',
                'constraint' => 80
            ],
            'created_time' => [
                'type' => 'DATETIME'
            ],
            'modified_time' => [
                'type' => 'DATETIME'
            ],
            'thumbnail_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'embed_url' => [
                'type' => 'VARCHAR',
                'constraint' => 73
            ],
        ]);

        $this->forge->addKey('file_id', true);
        $this->forge->createTable('drive_cache');
    }

    public function down()
    {
        $this->forge->dropTable('drive_cache');
    }
}
