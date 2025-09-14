<?php

namespace App\Models;

use CodeIgniter\Model;

class dataPembibitanModel extends Model
{
    protected $table      = 'data_bibit';
    protected $primaryKey = 'id_bibit';
    protected $allowedFields = [
        'id_kelompok', 'nama_sayur', 'tanggal_tanam', 'asal_bibit', 'keterangan', 'jumlah_semai', 'waktu_prakiraan_panen', 'prakiraan_jumlah_panen', 'waktu_panen', 'jumlah_panen', 'jumlah_kp', 'jumlah_ms', 'jumlah_sekolah', 'jumlah_pkk', 'jumlah_posyandu', 'jumlah_lainnya', 'jumlah_kk', 'jumlah_orang', 'jumlah_dijual_pohon', 'jumlah_dijual_orang', 'jumlah_dijual_kk', 'harga_jual','gambar'
    ];

    public function getDataBibit($id_bibit = false, $filter = null)
    {
        $builder = $this->db->table('data_bibit')
            ->join('data_kelompok', 'data_kelompok.id_kelompok = data_bibit.id_kelompok', 'left');

        // Jika ID bibit diberikan, ambil data spesifik
        if ($id_bibit) {
            return $builder->where('id_bibit', $id_bibit)->get()->getRowArray() ?: [];
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

    public function AlldataKelompok()
    {
        return $this->db->table('data_kelompok')
            ->select('penyuluh, id_kelompok')
            ->groupBy('penyuluh')
            ->get()
            ->getResultArray();
    }
}