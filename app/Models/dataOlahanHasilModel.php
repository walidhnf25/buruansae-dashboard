<?php

namespace App\Models;

use CodeIgniter\Model;

class dataOlahanhasilModel extends Model
{
    protected $table      = 'data_olahan_hasil';
    protected $primaryKey = 'id_data_olahan_hasil';
    protected $allowedFields = ['uji_lab', 'izin_halal', 'izin_pirt', 'resep', 'tanggal_produksi', 'jenis_olahan', 'bahan_dasar', 'merk','waktu_panen', 'jumlah_panen', 'harga_jual', 'gambar', 'jumlah_berat_kp_kg', 'jumlah_kepala_keluarga_kp_kk', 'jumlah_orang_kp', 'jumlah_berat_dibagikan_stunting_kg', 'jumlah_kepala_keluarga_dibagikan_stunting',
        'jumlah_orang_dibagikan_stunting', 'jumlah_berat_dibagikan_mm_kg', 'jumlah_kepala_keluarga_dibagikan_mm', 'jumlah_orang_dibagikan_mm', 'jumlah_berat_dibagikan_lansia_kg', 'jumlah_kepala_keluarga_dibagikan_lansia', 'jumlah_orang_dibagikan_lansia', 'jumlah_berat_dibagikan_posyandu_kg', 'jumlah_kepala_keluarga_dibagikan_posyandu', 'jumlah_orang_dibagikan_posyandu', 'jumlah_berat_dijual_kg', 'jumlah_orang_dijual', 'id_kelompok'
    ];

    public function getDataOlahanHasil($id_data_olahan_hasil = false, $filter = null)
    {
        $builder = $this->db->table('data_olahan_hasil')
            ->join('data_kelompok', 'data_kelompok.id_kelompok = data_olahan_hasil.id_kelompok', 'left');

        // Jika ID sayur diberikan, ambil data spesifik
        if ($id_data_olahan_hasil) {
            return $builder->where('id_data_olahan_hasil', $id_data_olahan_hasil)->get()->getRowArray() ?: [];
        }

        // Filter berdasarkan kondisi waktu_panen
        if ($filter == 'sudah_panen') {
            $builder->where('waktu_panen IS NOT NULL')
                    ->orderBy('waktu_panen', 'DESC'); // Urutkan yang sudah dipanen berdasarkan waktu panen terbaru
        } elseif ($filter == 'akan_panen') {
            $builder->where('waktu_panen IS NULL')
                    ->orderBy('tanggal_produksi', 'ASC'); // Urutkan yang belum dipanen berdasarkan waktu prakiraan panen
        } else {
            // Jika tanpa filter, urutkan berdasarkan kondisi waktu_panen dan tanggal_produksi
            $builder->orderBy("CASE WHEN waktu_panen IS NULL THEN tanggal_produksi ELSE waktu_panen END", "ASC", false)
                    ->orderBy("waktu_panen IS NOT NULL", "DESC", false); // Prioritaskan yang sudah dipanen di bawah
        }

        // Kembalikan semua data dengan filter (jika ada)
        $data = $builder->get()->getResultArray();
        return !empty($data) ? $data : []; // Kembalikan array kosong jika tidak ada data
    }
}