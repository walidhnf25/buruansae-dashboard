<?php

namespace App\Models;

use CodeIgniter\Model;

class dataSayurModel extends Model
{
    protected $table      = 'data_sayur';
    protected $primaryKey = 'id_sayur';
    protected $allowedFields = [
        'id_kelompok', 'nama_sayur', 'tanggal_tanam', 'kategori_tumbuhan', 'jumlah_tanam', 'waktu_panen',
        'jumlah_panen', 'konsumsi_lokal_kg', 'konsumsi_kk', 'konsumsi_orang', 'jumlah_jual', 'harga_jual',
        'lokasi_pembeli', 'dukungan_program_lain', 'data_pendukung', 'gambar'
    ];

    public function getDataSayur($id_sayur = false)
    {
        if ($id_sayur == false) {
            return $this->db->table('data_sayur')->orderBy('id_sayur', 'DESC')
                ->join('data_kelompok', 'data_kelompok.id_kelompok = data_sayur.id_kelompok', 'left')
                ->get()->getResultArray();
            // return $this->orderBy('id_sayur', 'DESC')->findAll();
        }
        return $this->where(['id_sayur' => $id_sayur])->first();
    }

    public function AlldataKelompok()
    {
        return $this->db->table('data_kelompok')
            ->select('penyuluh, id_kelompok')
            ->groupBy('penyuluh')
            ->get()
            ->getResultArray();
    }
}
