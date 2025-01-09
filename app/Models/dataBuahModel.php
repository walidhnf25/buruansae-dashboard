<?php

namespace App\Models;

use CodeIgniter\Model;

class dataBuahModel extends Model
{
    protected $table      = 'data_buah';
    protected $primaryKey = 'id_buah';
    protected $allowedFields = ['nama_buah', 'id_kelompok', 'tanggal_tanam', 'kategori_tumbuhan', 'jumlah_tanam','waktu_panen', 'jumlah_panen', 'konsumsi_lokal_kg', 'konsumsi_kk', 'konsumsi_orang', 'jumlah_jual', 'harga_jual', 'lokasi_pembeli', 'dukungan_program_lain', 'data_pendukung', 'gambar','jenis_pupuk','waktu_pupuk','jumlah_pupuk', 'jumlah_berat_kp_kg', 'jumlah_kepala_keluarga_kp_kk', 'jumlah_orang_kp', 'dibagikan', 'jumlah_berat_dibagikan_kg', 'jumlah_kepala_keluarga_dibagikan_kk',
        'jumlah_orang_dibagikan', 'jumlah_berat_dijual_kg', 'jumlah_kepala_keluarga_dijual_kk', 'jumlah_orang_dijual',
    ];

    public function getDataBuah($id_buah = false, $filter = null)
    {
        $builder = $this->db->table('data_buah')
            ->join('data_kelompok', 'data_kelompok.id_kelompok = data_buah.id_kelompok', 'left')
            ->orderBy('id_buah', 'DESC');

        // Jika ID buah diberikan, ambil data spesifik
        if ($id_buah) {
            return $builder->where('id_buah', $id_buah)->get()->getRowArray();
        }

        // Filter berdasarkan kondisi waktu_panen
        if ($filter == 'sudah_panen') {
            $builder->where('waktu_panen IS NOT NULL');
        } elseif ($filter == 'akan_panen') {
            $builder->where('waktu_panen IS NULL');
        }

        // Kembalikan semua data dengan filter (jika ada)
        return $builder->get()->getResultArray();
    }
}