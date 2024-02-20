<?php 

namespace App\Models;
use CodeIgniter\Model;

class dataTernakModel extends Model
{
    protected $table      = 'data_ternak';
    protected $primaryKey = 'id_ternak';
    protected $allowedFields = ['waktu_pakan', 'jenis_ternak', 'jumlah_pakan', 'jumlah_ternak', 'waktu_panen', 'jumlah_panen', 'konsumsi_lokal_kg', 'konsumsi_kk', 'konsumsi_orang', 'jumlah_jual', 'harga_jual', 'lokasi_pembeli', 'gambar'];

    public function getDataTernak($id_ternak = false)
    {
        if($id_ternak == false){
            return $this->findAll();
        }
        return $this->where(['id_ternak' => $id_ternak])->first();
    }
}