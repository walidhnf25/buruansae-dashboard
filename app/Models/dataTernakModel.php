<?php 

namespace App\Models;
use CodeIgniter\Model;

class dataTernakModel extends Model
{
    protected $table      = 'data_ternak';
    protected $primaryKey = 'id_ternak';
    protected $allowedFields = ['waktu_pakan', 'id_kelompok', 'jenis_ternak', 'jumlah_pakan', 'jumlah_ternak', 'prakiraan_jumlah_panen', 'waktu_prakiraan_panen', 'waktu_panen', 'jumlah_panen_kg', 'jumlah_panen_ekor', 'konsumsi_lokal_kg', 'konsumsi_kk', 'konsumsi_orang', 'jumlah_jual', 'harga_jual', 'lokasi_pembeli', 'jumlah_berat_kp_kg', 'jumlah_kepala_keluarga_kp_kk', 'jumlah_orang_kp', 'jumlah_berat_dibagikan_stunting_kg', 'jumlah_kepala_keluarga_dibagikan_stunting',
        'jumlah_orang_dibagikan_stunting', 'jumlah_berat_dibagikan_mm_kg', 'jumlah_kepala_keluarga_dibagikan_mm', 'jumlah_orang_dibagikan_mm', 'jumlah_berat_dibagikan_lansia_kg', 'jumlah_kepala_keluarga_dibagikan_lansia', 'jumlah_orang_dibagikan_lansia', 'jumlah_berat_dibagikan_posyandu_kg', 'jumlah_kepala_keluarga_dibagikan_posyandu', 'jumlah_orang_dibagikan_posyandu', 'jumlah_berat_dijual_kg', 'jumlah_orang_dijual', 'jumlah_berat_dijual_kg', 'jumlah_orang_dijual', 'gambar'
    ];

    public function getDataTernak($id_ternak = false, $filter = null)
    {
        $builder = $this->db->table('data_ternak')
            ->select('data_ternak.*, data_kelompok.nama_kelompok, data_kelompok.penyuluh, data_kelompok.pendamping, data_kelompok.kecamatan, data_kelompok.kelurahan, data_kelompok.rw')
            ->join('data_kelompok', 'data_kelompok.id_kelompok = data_ternak.id_kelompok', 'left')
            ->orderBy('id_ternak', 'DESC');

        // Jika ID ternak diberikan, ambil data spesifik
        if ($id_ternak) {
            return $builder->where('id_ternak', $id_ternak)->get()->getRowArray();
        }

        // Filter berdasarkan kondisi waktu_panen
        if (!empty($filter)) {
            if ($filter == 'sudah_panen') {
                $builder->where('data_ternak.waktu_panen IS NOT NULL');
            } elseif ($filter == 'akan_panen') {
                $builder->where('data_ternak.waktu_panen IS NULL');
            }
        }

        // Kembalikan semua data dengan filter
        return $builder->get()->getResultArray();
    }
}