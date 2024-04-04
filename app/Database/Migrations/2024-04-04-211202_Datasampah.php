<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Datasampah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sampah' => [
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
            'tanggal_masuk' => [
                'type' => 'DATE',
                'null' => true
            ],
            'jenis_pengolahan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'jumlah_sampah' => [
                'type' => 'DOUBLE',
                'null' => true,
            ],
            'produk_hasil' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'waktu_sebaran' => [
                'type' => 'DATE',
                'null' => true
            ],
            'penggunaan_lokal' => [
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
        $this->forge->addKey('id_sampah', true);
        $this->forge->addForeignKey('id_kelompok', 'data_kelompok', 'id_kelompok');
        $this->forge->createTable('data_sampah');
    }

    public function down()
    {
        $this->forge->dropForeignKey('data_sampah', 'data_sampah_id_kelompok_foreign');
        $this->forge->dropTable('data_sampah');
    }
}
