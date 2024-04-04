<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Datasayur extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sayur' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_kelompok' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nama_sayur' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'tanggal_tanam' => [
                'type' => 'DATE',
                'null' => false
            ],
            'kategori_tumbuhan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'jumlah_tanam' => [
                'type' => 'DOUBLE',
                'null' => false
            ],
            'waktu_panen' => [
                'type' => 'DATE',
                'null' => true
            ],
            'jumlah_panen' => [
                'type' => 'DOUBLE',
                'null' => true
            ],
            'konsumsi_lokal_kg' => [
                'type' => 'INT',
                'constraint' => '255',
                'null' => true,
            ],
            'konsumsi_kk' => [
                'type' => 'INT',
                'constraint' => '255',
                'null' => true,
            ],
            'konsumsi_orang' => [
                'type' => 'INT',
                'constraint' => '255',
                'null' => true,
            ],
            'jumlah_jual' => [
                'type' => 'INT',
                'constraint' => '255',
                'null' => true,
            ],
            'harga_jual' => [
                'type' => 'BIGINT',
                'constraint' => '255',
                'null' => true,
            ],
            'lokasi_pembeli' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'dukungan_program_lain' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'data_pendukung' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_sayur', true);
        $this->forge->addForeignKey('id_kelompok', 'data_kelompok', 'id_kelompok');
        $this->forge->createTable('data_sayur');
    }

    public function down()
    {
        $this->forge->dropForeignKey('data_sayur', 'data_sayur_id_kelompok_foreign');
        $this->forge->dropTable('data_sayur');
    }
}
