<?php

namespace App\Models;

use CodeIgniter\Model;

class dataSayurModel extends Model
{
    protected $table      = 'data_sayur';
    protected $primaryKey = 'id_sayur';
    protected $allowedFields = [
        'id_kelompok', 'nama_sayur', 'tanggal_tanam', 'kategori_tumbuhan', 'jumlah_tanam', 'waktu_prakiraan_panen', 'waktu_panen',
        'jumlah_panen', 'konsumsi_lokal_kg', 'konsumsi_kk', 'konsumsi_orang', 'jumlah_jual', 'harga_jual',
        'lokasi_pembeli', 'dukungan_program_lain', 'data_pendukung', 'gambar', 'jumlah_berat_kp_kg', 'jumlah_kepala_keluarga_kp_kk', 'jumlah_orang_kp', 'dibagikan', 'jumlah_berat_dibagikan_kg', 'jumlah_kepala_keluarga_dibagikan_kk',
        'jumlah_orang_dibagikan', 'jumlah_berat_dijual_kg', 'jumlah_kepala_keluarga_dijual_kk', 'jumlah_orang_dijual',
    ];

    public function getDataSayur($id_sayur = false, $filter = null)
    {
        $builder = $this->db->table('data_sayur')
            ->join('data_kelompok', 'data_kelompok.id_kelompok = data_sayur.id_kelompok', 'left')
            ->orderBy('id_sayur', 'DESC');

        // Jika ID sayur diberikan, ambil data spesifik
        if ($id_sayur) {
            return $builder->where('id_sayur', $id_sayur)->get()->getRowArray();
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

    public function AlldataKelompok()
    {
        return $this->db->table('data_kelompok')
            ->select('penyuluh, id_kelompok')
            ->groupBy('penyuluh')
            ->get()
            ->getResultArray();
    }
}
