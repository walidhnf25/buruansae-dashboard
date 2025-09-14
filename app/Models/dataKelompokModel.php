<?php

namespace App\Models;

use CodeIgniter\Model;

class dataKelompokModel extends Model
{
    protected $table      = 'data_kelompok';
    protected $primaryKey = 'id_kelompok';
    protected $allowedFields = ['nama_kelompok', 'nama_ketua', 'nomor_kontak', 'luas_lahan', 'status_lahan', 'status_keaktifan', 'keterangan_status', 'penyuluh', 'pendamping', 'kecamatan', 'kelurahan', 'rw', 'latitude', 'longtitude', 'link_deskripsi', 'foto_lahan', 'foto_ketua'];

    public function getDataKelompok($id_kelompok = false)
    {
        if ($id_kelompok == false) {
            return $this->orderBy('id_kelompok', 'DESC')->findAll();
        }
        return $this->where(['id_kelompok' => $id_kelompok])->first();
    }
}