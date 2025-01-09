<?php

namespace App\Models;
use CodeIgniter\Model;

class dataTanamanObatModel extends Model
{
    protected $table      = 'data_tanaman_obat';
    protected $primaryKey = 'id_tanaman_obat';
    protected $allowedFields = ['nama_tanaman_obat', 'id_kelompok', 'tanggal_tanam', 'kategori_tumbuhan', 'jumlah_tanam', 'waktu_prakiraan_panen', 'waktu_panen', 'jumlah_panen', 'konsumsi_lokal_kg', 'konsumsi_kk', 'konsumsi_orang', 'jumlah_jual', 'harga_jual', 'lokasi_pembeli', 'dukungan_program_lain', 'data_pendukung', 'gambar', 'jumlah_berat_kp_kg', 'jumlah_kepala_keluarga_kp_kk', 'jumlah_orang_kp', 'dibagikan', 'jumlah_berat_dibagikan_kg', 'jumlah_kepala_keluarga_dibagikan_kk',
        'jumlah_orang_dibagikan', 'jumlah_berat_dijual_kg', 'jumlah_kepala_keluarga_dijual_kk', 'jumlah_orang_dijual',
    ];

    public function getDataTanamanObat($id_tanaman_obat = false, $filter = null)
    {
        $builder = $this->db->table('data_tanaman_obat')
            ->join('data_kelompok', 'data_kelompok.id_kelompok = data_tanaman_obat.id_kelompok', 'left')
            ->orderBy('id_tanaman_obat', 'DESC');

        // Jika ID tanaman obat diberikan, ambil data spesifik
        if ($id_tanaman_obat) {
            return $builder->where('id_tanaman_obat', $id_tanaman_obat)->get()->getRowArray();
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