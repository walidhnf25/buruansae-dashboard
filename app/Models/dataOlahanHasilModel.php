<?php

namespace App\Models;

use CodeIgniter\Model;

class dataOlahanhasilModel extends Model
{
    protected $table      = 'data_olahan_hasil';
    protected $primaryKey = 'id_data_olahan_hasil';
    protected $allowedFields = ['uji_lab', 'izin_halal', 'izin_pirt', 'resep', 'tanggal_produksi', 'jenis_olahan', 'bahan_dasar', 'merk','waktu_jual', 'konsumsi_lokal_kg', 'konsumsi_kk', 'konsumsi_orang', 'jumlah_jual', 'harga_jual', 'lokasi_pembeli', 'dukungan_program_lain', 'data_pendukung', 'gambar'];

    public function getDataOlahanHasil($id_data_olahan_hasil = false)
    {
        if($id_data_olahan_hasil == false){
            return $this->findAll();
        }
        return $this->where(['id_data_olahan_hasil' => $id_data_olahan_hasil])->first();
    }
}