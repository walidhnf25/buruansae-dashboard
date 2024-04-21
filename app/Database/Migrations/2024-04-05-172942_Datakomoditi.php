<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Datakomoditi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_komoditi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_komoditi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'sektor' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'durasi_tanam' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'start_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'end_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_komoditi', true);
        $this->forge->createTable('data_komoditi');
    }

    public function down()
    {
        $this->forge->dropTable('data_komoditi');
    }
}
