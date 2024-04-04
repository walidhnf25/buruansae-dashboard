<?php

namespace App\Models;
use CodeIgniter\Model;

class dataTanamanObatModel extends Model
{
    protected $table      = 'data_tanaman_obat';
    protected $primaryKey = 'id_tanaman_obat';
    protected $allowedFields = ['nama_tanaman_obat', 'id_kelompok', 'tanggal_tanam', 'kategori_tumbuhan', 'jumlah_tanam', 'waktu_panen', 'jumlah_panen', 'konsumsi_lokal_kg', 'konsumsi_kk', 'konsumsi_orang', 'jumlah_jual', 'harga_jual', 'lokasi_pembeli', 'dukungan_program_lain', 'data_pendukung', 'gambar'];

    public function getDataTanamanObat($id_tanaman_obat = false)
    {
        if($id_tanaman_obat == false){
            return $this->db->table('data_tanaman_obat')->orderBy('id_tanaman_obat', 'DESC')
            ->join('data_kelompok', 'data_kelompok.id_kelompok = data_tanaman_obat.id_kelompok', 'left')
            ->get()->getResultArray();
        }
        return $this->where(['id_tanaman_obat' => $id_tanaman_obat])->first();
    }
}