<?php

namespace App\Models;

use CodeIgniter\Model;

class dataIkanModel extends Model
{
    protected $table      = 'data_ikan';
    protected $primaryKey = 'id_ikan';
    protected $allowedFields = ['waktu_pakan', 'id_kelompok', 'jenis_ikan', 'jumlah_pakan', 'jumlah_ikan','waktu_panen', 'jumlah_panen_kg', 'jumlah_panen_ekor', 'prakiraan_jumlah_panen', 'waktu_prakiraan_panen', 'harga_jual', 'gambar', 'jumlah_berat_kp_kg', 'jumlah_kepala_keluarga_kp_kk', 'jumlah_orang_kp', 'jumlah_berat_dibagikan_stunting_kg', 'jumlah_kepala_keluarga_dibagikan_stunting',
        'jumlah_orang_dibagikan_stunting', 'jumlah_berat_dibagikan_mm_kg', 'jumlah_kepala_keluarga_dibagikan_mm', 'jumlah_orang_dibagikan_mm', 'jumlah_berat_dibagikan_lansia_kg', 'jumlah_kepala_keluarga_dibagikan_lansia', 'jumlah_orang_dibagikan_lansia', 'jumlah_berat_dibagikan_posyandu_kg', 'jumlah_kepala_keluarga_dibagikan_posyandu', 'jumlah_orang_dibagikan_posyandu', 'jumlah_berat_dijual_kg', 'jumlah_orang_dijual'
    ];

    public function getDataIkan($id_ikan = false, $filter = null)
    {
        $builder = $this->db->table('data_ikan')
            ->select('data_ikan.*, data_kelompok.nama_kelompok, data_kelompok.penyuluh, data_kelompok.pendamping, data_kelompok.kecamatan, data_kelompok.kelurahan, data_kelompok.rw')
            ->join('data_kelompok', 'data_kelompok.id_kelompok = data_ikan.id_kelompok', 'left')
            ->orderBy('id_ikan', 'DESC');

        // Jika ID ikan diberikan, ambil data spesifik
        if ($id_ikan) {
            return $builder->where('id_ikan', $id_ikan)->get()->getRowArray();
        }

        // Filter berdasarkan kondisi waktu_panen
        if (!empty($filter)) {
            if ($filter == 'sudah_panen') {
                $builder->where('data_ikan.waktu_panen IS NOT NULL');
            } elseif ($filter == 'akan_panen') {
                $builder->where('data_ikan.waktu_panen IS NULL');
            }
        }

        // Kembalikan semua data
        return $builder->get()->getResultArray();
    }
}