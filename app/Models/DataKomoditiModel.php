<?php

namespace App\Models;

use CodeIgniter\Model;

class DataKomoditiModel extends Model
{
    protected $table      = 'data_komoditi';
    protected $primaryKey = 'id_komoditi';
    protected $allowedFields = ['nama_komoditi', 'sektor', 'durasi_tanam'];

    public function getDataKomoditi($id_komoditi = false)
    {
        if ($id_komoditi == false) {
            return $this->orderBy('id_komoditi', 'DESC')->findAll();
        }
        return $this->where(['id_komoditi' => $id_komoditi])->first();
    }
}
