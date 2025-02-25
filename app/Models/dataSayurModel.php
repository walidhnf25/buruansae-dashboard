<?php

namespace App\Models;

use CodeIgniter\Model;

class dataSayurModel extends Model
{
    protected $table      = 'data_sayur';
    protected $primaryKey = 'id_sayur';
    protected $allowedFields = [
        'id_kelompok', 'nama_sayur', 'tanggal_tanam', 'kategori_tumbuhan', 'jumlah_tanam', 'prakiraan_jumlah_panen', 'waktu_prakiraan_panen', 'waktu_panen', 'jumlah_panen', 'harga_jual', 'gambar', 'jumlah_berat_kp_kg', 'jumlah_kepala_keluarga_kp_kk', 'jumlah_orang_kp', 'jumlah_berat_dibagikan_stunting_kg', 'jumlah_kepala_keluarga_dibagikan_stunting',
        'jumlah_orang_dibagikan_stunting', 'jumlah_berat_dibagikan_mm_kg', 'jumlah_kepala_keluarga_dibagikan_mm', 'jumlah_orang_dibagikan_mm', 'jumlah_berat_dibagikan_lansia_kg', 'jumlah_kepala_keluarga_dibagikan_lansia', 'jumlah_orang_dibagikan_lansia', 'jumlah_berat_dibagikan_posyandu_kg', 'jumlah_kepala_keluarga_dibagikan_posyandu', 'jumlah_orang_dibagikan_posyandu', 'jumlah_berat_dijual_kg', 'jumlah_orang_dijual'
    ];

    public function getDataSayur($id_sayur = false, $filter = null)
    {
        $builder = $this->db->table('data_sayur')
            ->join('data_kelompok', 'data_kelompok.id_kelompok = data_sayur.id_kelompok', 'left')
            ->orderBy('id_sayur', 'DESC');

        // Jika ID sayur diberikan, ambil data spesifik
        if ($id_sayur) {
            return $builder->where('id_sayur', $id_sayur)->get()->getRowArray() ?: [];
        }

        // Filter berdasarkan kondisi waktu_panen
        if ($filter == 'sudah_panen') {
            $builder->where('waktu_panen IS NOT NULL');
        } elseif ($filter == 'akan_panen') {
            $builder->where('waktu_panen IS NULL');
        }

        // Kembalikan semua data dengan filter (jika ada)
        $data = $builder->get()->getResultArray();
        return !empty($data) ? $data : []; // Kembalikan array kosong jika tidak ada data
    }

    public function AlldataKelompok()
    {
        return $this->db->table('data_kelompok')
            ->select('penyuluh, id_kelompok')
            ->groupBy('penyuluh')
            ->get()
            ->getResultArray();
    }
}
