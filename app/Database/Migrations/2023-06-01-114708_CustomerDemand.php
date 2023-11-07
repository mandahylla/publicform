<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CustomerDemand extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'fullname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'role' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'created_at' => [
                'type'           => 'datetime'
            ],
            'updated_at' => [
                'type'           => 'datetime'
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user_demands');
    }

    public function down()
    {
        $this->forge->dropTable('user_demands');
    }
}
