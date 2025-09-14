<?php

namespace App\Models;

use CodeIgniter\Model;

class dataBuahModel extends Model
{
    protected $table      = 'data_buah';
    protected $primaryKey = 'id_buah';
    protected $allowedFields = ['nama_buah', 'id_kelompok', 'tanggal_tanam', 'kategori_tumbuhan', 'jumlah_tanam','waktu_panen', 'jumlah_panen', 'harga_jual', 'gambar','jenis_pupuk','waktu_pupuk','jumlah_pupuk', 'prakiraan_jumlah_panen', 'waktu_prakiraan_panen', 'jumlah_berat_kp_kg', 'jumlah_kepala_keluarga_kp_kk', 'jumlah_orang_kp', 'jumlah_berat_dibagikan_stunting_kg', 'jumlah_kepala_keluarga_dibagikan_stunting',
        'jumlah_orang_dibagikan_stunting', 'jumlah_berat_dibagikan_mm_kg', 'jumlah_kepala_keluarga_dibagikan_mm', 'jumlah_orang_dibagikan_mm', 'jumlah_berat_dibagikan_lansia_kg', 'jumlah_kepala_keluarga_dibagikan_lansia', 'jumlah_orang_dibagikan_lansia', 'jumlah_berat_dibagikan_posyandu_kg', 'jumlah_kepala_keluarga_dibagikan_posyandu', 'jumlah_orang_dibagikan_posyandu', 'jumlah_berat_dijual_kg', 'jumlah_orang_dijual',
    ];

    public function getDataBuah($id_buah = false, $filter = null)
    {
        $builder = $this->db->table('data_buah')
            ->join('data_kelompok', 'data_kelompok.id_kelompok = data_buah.id_kelompok', 'left');

        // Jika ID sayur diberikan, ambil data spesifik
        if ($id_buah) {
            return $builder->where('id_buah', $id_buah)->get()->getRowArray() ?: [];
        }

        // Filter berdasarkan kondisi waktu_panen
        if ($filter == 'sudah_panen') {
            $builder->where('waktu_panen IS NOT NULL')
                    ->orderBy('waktu_panen', 'DESC'); // Urutkan yang sudah dipanen berdasarkan waktu panen terbaru
        } elseif ($filter == 'akan_panen') {
            $builder->where('waktu_panen IS NULL')
                    ->orderBy('waktu_prakiraan_panen', 'ASC'); // Urutkan yang belum dipanen berdasarkan waktu prakiraan panen
        } else {
            // Jika tanpa filter, urutkan berdasarkan kondisi waktu_panen dan waktu_prakiraan_panen
            $builder->orderBy("CASE WHEN waktu_panen IS NULL THEN waktu_prakiraan_panen ELSE waktu_panen END", "ASC", false)
                    ->orderBy("waktu_panen IS NOT NULL", "DESC", false); // Prioritaskan yang sudah dipanen di bawah
        }

        // Kembalikan semua data dengan filter (jika ada)
        $data = $builder->get()->getResultArray();
        return !empty($data) ? $data : []; // Kembalikan array kosong jika tidak ada data
    }
}