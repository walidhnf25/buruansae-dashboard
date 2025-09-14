<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\Database\BaseConnection;

class Home extends BaseController
{
    protected $db; // Tambahkan properti db

    public function __construct()
    {
        $this->db = \Config\Database::connect(); // Inisialisasi database
    }
    
    public function index()
    {
        $tanggalHariIni = date('Y-m-d');

        $data = [
            'tittle' => 'Buruan SAE | Home',
            'jumlahSayur' => $this->db->table('data_sayur')->where('waktu_prakiraan_panen <=', $tanggalHariIni)->where('waktu_panen IS NULL')->countAllResults() ?? 0,
            'jumlahTanamanObat' => $this->db->table('data_tanaman_obat')->where('waktu_prakiraan_panen <=', $tanggalHariIni)->where('waktu_panen IS NULL')->countAllResults() ?? 0,
            'jumlahBuah' => $this->db->table('data_buah')->where('waktu_prakiraan_panen <=', $tanggalHariIni)->where('waktu_panen IS NULL')->countAllResults() ?? 0,
            'jumlahTernak' => $this->db->table('data_ternak')->where('waktu_prakiraan_panen <=', $tanggalHariIni)->where('waktu_panen IS NULL')->countAllResults() ?? 0,
            'jumlahIkan' => $this->db->table('data_ikan')->where('waktu_prakiraan_panen <=', $tanggalHariIni)->where('waktu_panen IS NULL')->countAllResults() ?? 0,
            'jumlahOlahanHasil' => $this->db->table('data_olahan_hasil')->where('tanggal_produksi <=', $tanggalHariIni)->where('waktu_panen IS NULL')->countAllResults() ?? 0,
            'jumlahOlahanSampah' => $this->db->table('data_olahan_hasil')->where('tanggal_produksi <=', $tanggalHariIni)->where('waktu_panen IS NULL')->countAllResults() ?? 0,
            'jumlahBibit' => $this->db->table('data_olahan_hasil')->where('tanggal_produksi <=', $tanggalHariIni)->where('waktu_panen IS NULL')->countAllResults() ?? 0,
        ];

        return view('pages/home', $data);
    }
}
