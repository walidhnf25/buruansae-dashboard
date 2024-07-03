<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Datakelompok extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kelompok' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
        // $this->forge->addForeignKey('id_olahan_hasil', 'data_olahan_hasil', 'id_olahan_hasil');
        // $this->forge->addForeignKey('id_sayur', 'data_sayur', 'id_sayur');
        // $this->forge->addForeignKey('id_buah', 'data_buah', 'id_buah');
        // $this->forge->addForeignKey('id_ternak', 'data_ternak', 'id_ternak');
        // $this->forge->addForeignKey('id_ikan', 'data_ikan', 'id_ikan');
        // $this->forge->addForeignKey('id_tanaman_obat', 'data_tanaman_obat', 'id_tanaman_obat');
        // $this->forge->addForeignKey('id_data_sampah', 'data_sampah', 'id_data_sampah');
        $this->forge->createTable('data_kelompok');
    }

    public function down()
    {
        // $this->forge->dropForeignKey('data_kelompok', 'data_kelompok_id_olahan_hasil_foreign');
        // $this->forge->dropForeignKey('data_kelompok', 'data_kelompok_id_sayur_foreign');
        // $this->forge->dropForeignKey('data_kelompok', 'data_kelompok_id_buah_foreign');
        // $this->forge->dropForeignKey('data_kelompok', 'data_kelompok_id_ternak_foreign');
        // $this->forge->dropForeignKey('data_kelompok', 'data_kelompok_id_ikan_foreign');
        // $this->forge->dropForeignKey('data_kelompok', 'data_kelompok_id_tanaman_obat_foreign');
        // $this->forge->dropForeignKey('data_kelompok', 'data_kelompok_id_data_sampah_foreign');
        $this->forge->dropTable('data_kelompok');
    }
}
