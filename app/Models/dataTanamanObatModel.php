<?php

namespace App\Models;
use CodeIgniter\Model;

class dataTanamanObatModel extends Model
{
    protected $table      = 'data_tanaman_obat';
    protected $primaryKey = 'id_tanaman_obat';
    protected $allowedFields = ['nama_tanaman_obat', 'tanggal_tanam', 'kategori_tumbuhan', 'jumlah_tanam', 'waktu_panen', 'jumlah_panen', 'konsumsi_lokal_kg', 'konsumsi_kk', 'konsumsi_orang', 'jumlah_jual', 'harga_jual', 'lokasi_pembeli', 'dukungan_program_lain', 'data_pendukung', 'gambar'];

    public function getDataTanamanObat($id_tanaman_obat = false)
    {
        if($id_tanaman_obat == false){
            return $this->findAll();
        }
        return $this->where(['id_tanaman_obat' => $id_tanaman_obat])->first();
    }
}