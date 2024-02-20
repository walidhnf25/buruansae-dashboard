<?php

namespace App\Models;

use CodeIgniter\Model;

class dataIkanModel extends Model
{
    protected $table      = 'data_ikan';
    protected $primaryKey = 'id_ikan';
    protected $allowedFields = ['waktu_pakan', 'jenis_ikan', 'jumlah_pakan', 'jumlah_ikan','waktu_panen', 'jumlah_panen', 'konsumsi_lokal_kg', 'konsumsi_kk', 'konsumsi_orang', 'jumlah_jual', 'harga_jual', 'lokasi_pembeli', 'dukungan_program_lain', 'data_pendukung', 'gambar'];

    public function getDataIkan($id_ikan = false)
    {
        if($id_ikan == false){
            return $this->findAll();
        }
        return $this->where(['id_ikan' => $id_ikan])->first();
    }
}