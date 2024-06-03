<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dataolahanhasil extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_data_olahan_hasil' => [
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
            'uji_lab' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'izin_halal' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'izin_pirt' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'resep' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'tanggal_produksi' => [
                'type' => 'DATE',
                'null' => false
            ],
            'jenis_olahan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'bahan_dasar' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'merk' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'waktu_jual' => [
                'type' => 'DATE',
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
                'type' => 'DOUBLE',
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
        $this->forge->addKey('id_data_olahan_hasil', true);
        $this->forge->addForeignKey('id_kelompok', 'data_kelompok', 'id_kelompok');
        $this->forge->createTable('data_olahan_hasil');
    }

    public function down()
    {
        $this->forge->dropForeignKey('data_olahan_hasil', 'data_olahan_hasil_id_kelompok_foreign');
        $this->forge->dropTable('data_olahan_hasil');
    }
}
