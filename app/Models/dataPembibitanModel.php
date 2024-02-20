<?php

namespace App\Models;

use CodeIgniter\Model;

class dataPembibitanModel extends Model
{
    protected $table      = 'data_pembibitan';
    protected $primaryKey = 'id_bibit';
    protected $allowedFields = ['kategori_pembibitan', 'tipe_tumbuhan', 'tanggal_pembibitan', 'jumlah_pembibitan','waktu_panen', 'jumlah_panen', 'konsumsi_lokal_kg', 'konsumsi_kk', 'konsumsi_orang', 'jumlah_jual', 'harga_jual', 'lokasi_pembeli', 'dukungan_program_lain', 'data_pendukung', 'gambar'];

    public function getDataPembibitan($id_bibit = false)
    {
        if($id_bibit == false){
            return $this->findAll();
        }
        return $this->where(['id_bibit' => $id_bibit])->first();
    }
}