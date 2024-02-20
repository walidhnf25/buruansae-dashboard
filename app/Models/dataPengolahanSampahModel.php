<?php

namespace App\Models;

use CodeIgniter\Model;

class dataPengolahanSampahModel extends Model
{
    protected $table      = 'data_sampah';
    protected $primaryKey = 'id_data_sampah';
    protected $allowedFields = ['tanggal_masuk', 'jenis_pengolahan', 'jumlah_sampah','produk_hasil','waktu_sebaran','penggunaan_lokal','jumlah_jual','harga_jual','lokasi_pembeli','dukungan_program_lain','program_pendukung','gambar'];

    public function getDataSampah($id_data_sampah = false)
    {
        if($id_data_sampah == false){
            return $this->findAll();
        }
        return $this->where(['id_data_sampah' => $id_data_sampah])->first();
    }
}