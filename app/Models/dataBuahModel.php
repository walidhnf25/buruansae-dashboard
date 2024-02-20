<?php

namespace App\Models;

use CodeIgniter\Model;

class dataBuahModel extends Model
{
    protected $table      = 'data_buah';
    protected $primaryKey = 'id_buah';
    protected $allowedFields = ['nama_buah', 'tanggal_tanam', 'kategori_tumbuhan', 'jumlah_tanam','waktu_panen', 'jumlah_panen', 'konsumsi_lokal_kg', 'konsumsi_kk', 'konsumsi_orang', 'jumlah_jual', 'harga_jual', 'lokasi_pembeli', 'dukungan_program_lain', 'data_pendukung', 'gambar','jenis_pupuk','waktu_pupuk','jumlah_pupuk'];

    public function getDataBuah($id_buah = false)
    {
        if($id_buah == false){
            return $this->findAll();
        }
        return $this->where(['id_buah' => $id_buah])->first();
    }
}