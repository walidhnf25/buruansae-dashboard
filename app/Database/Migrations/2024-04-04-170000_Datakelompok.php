<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Datakelompok extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kelompok' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'penyuluh' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'pendamping' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'kecamatan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'kelurahan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'rw' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'nama_kelompok' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_kelompok', true);
        // $this->forge->addForeignKey('id_komoditi', 'data_komoditi', 'id_komoditi');
        $this->forge->createTable('data_kelompok');
    }

    public function down()
    {
        // $this->forge->dropForeignKey('data_kelompok', 'data_kelompok_id_komoditi_foreign');
        $this->forge->dropTable('data_kelompok');
    }
}
