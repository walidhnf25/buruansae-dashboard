<?php

namespace App\Controllers;

use App\Models\dataKelompokModel;
use App\Models\dataOlahanHasilModel;
use App\Models\DataKomoditiModel;


class DataOlahanHasil extends BaseController
{
    protected $dataOlahanHasilModel;
    protected $dataKelompokModel;
    protected $dataKomoditiModel;

    public function __construct()
    {
        $this->dataOlahanHasilModel = new dataOlahanhasilModel();
        $this->dataKelompokModel = new dataKelompokModel();
        $this->dataKomoditiModel = new DataKomoditiModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // Ambil filter dari query string (GET parameter)
        $filter = $this->request->getGet('filter');

        // Hitung jumlah komoditi yang sudah melewati waktu panen (tanggal_produksi <= hari ini DAN waktu_panen masih NULL)
        $jumlahTerlambatPanen = $this->db->table('data_olahan_hasil')
            ->where('tanggal_produksi <=', date('Y-m-d'))
            ->where('waktu_panen IS NULL')
            ->countAllResults();
            
        $data = [
            'tittle' => 'Data Olahan Hasil | Buruan SAE',
            'data_olahan_hasil' => $this->dataOlahanHasilModel->getDataOlahanHasil(false, $filter),
            'komoditi' => $this->db->table('data_komoditi')->get()->getResultArray(),
            'filter' => $filter,
            'jumlahTerlambatPanen' => $jumlahTerlambatPanen,
            'validation' => \Config\Services::validation()
        ];

        return view('pages/dataOlahanHasil', $data);
    }

    public function tambahDataOlahanHasil()
    {
        $data = [
            'tittle' => 'Data Olahan Hasil | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'kelompok' => $this->dataKelompokModel->getDataKelompok(),
            'olahan_hasil' => $this->dataOlahanHasilModel->getDataOlahanHasil(),
            'komoditi' => $this->dataKomoditiModel->where('sektor', 'OLAHAN HASIL')->findAll()
        ];
        return view('pages/tambahDataOlahanHasil', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'uji_lab' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan hasil uji lab'
                ]
            ],
            'tanggal_produksi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal produksi'
                ]
            ],
            'izin_halal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan izin halal'
                ]
            ],
            'izin_pirt' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan izin PIRT'
                ]
            ],
            'resep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan resep'
                ]
            ],
            'jenis_olahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan jenis olahan'
                ]
            ],
            'bahan_dasar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan bahan dasar'
                ]
            ],
            'merk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan merk'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataOlahanHasil/tambahDataOlahanHasil')->withInput()->with('validation', $validation);
        }

        $this->dataOlahanHasilModel->save([
            'id_kelompok' => $this->request->getVar('id_kelompok'),
            'uji_lab' => $this->request->getVar('uji_lab'),
            'tanggal_produksi' => $this->request->getVar('tanggal_produksi'),
            'izin_halal' => $this->request->getVar('izin_halal'),
            'izin_pirt' => $this->request->getVar('izin_pirt'),
            'resep' => $this->request->getVar('resep'),
            'jenis_olahan' => $this->request->getVar('jenis_olahan'),
            'bahan_dasar' => $this->request->getVar('bahan_dasar'),
            'merk' => $this->request->getVar('merk')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/dataOlahanHasil');
    }

    public function delete($id_data_olahan_hasil)
    {
        $this->dataOlahanHasilModel->delete($id_data_olahan_hasil);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/dataOlahanHasil');
    }

    public function editDataOlahanHasil($id_data_olahan_hasil)
    {
        $data = [
            'tittle' => 'Data Olahan Hasil | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'olahan_hasil' => $this->dataOlahanHasilModel->getDataOlahanHasil($id_data_olahan_hasil),
            'kelompok' => $this->dataKelompokModel->getDataKelompok(),
            'komoditi' => $this->dataKomoditiModel->where('sektor', 'OLAHAN HASIL')->findAll()
        ];

        return view('pages/editDataOlahanHasil', $data);
    }

    public function update($id_data_olahan_hasil)
    {
        // validasi input
        if (!$this->validate([
            'uji_lab' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan hasil uji lab'
                ]
            ],
            'tanggal_produksi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal produksi'
                ]
            ],
            'izin_halal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan izin halal'
                ]
            ],
            'izin_pirt' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan izin PIRT'
                ]
            ],
            'resep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan resep'
                ]
            ],
            'jenis_olahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan jenis olahan'
                ]
            ],
            'bahan_dasar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan bahan dasar'
                ]
            ],
            'merk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan merk'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataOlahanHasil' . $this->request->getVar('id_data_olahan_hasil'))->withInput()->with('validation', $validation);
        }

        $this->dataOlahanHasilModel->save([
            'id_data_olahan_hasil' => $id_data_olahan_hasil,
            'id_kelompok' => $this->request->getVar('id_kelompok'),
            'uji_lab' => $this->request->getVar('uji_lab'),
            'tanggal_produksi' => $this->request->getVar('tanggal_produksi'),
            'izin_halal' => $this->request->getVar('izin_halal'),
            'izin_pirt' => $this->request->getVar('izin_pirt'),
            'resep' => $this->request->getVar('resep'),
            'jenis_olahan' => $this->request->getVar('jenis_olahan'),
            'bahan_dasar' => $this->request->getVar('bahan_dasar'),
            'merk' => $this->request->getVar('merk')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/dataOlahanHasil');
    }

    public function dataProduksi($id_data_olahan_hasil)
    {
        $data = [
            'tittle' => 'Data Olahan Hasil | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'olahan_hasil' => $this->dataOlahanHasilModel->getDataOlahanHasil($id_data_olahan_hasil)
        ];
        return view('pages/dataProduksi', $data);
    }

    public function tambah_data_produksi($id_data_olahan_hasil)
    {
        if ($this->validate([
            'waktu_panen' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
            'jumlah_panen' => [
                'rules' => 'required|numeric[id_sayur.jumlah_panen]',
                'errors' => [
                    'required' => 'Masukkan Jumlah Panen !!',
                    'numeric' => 'Masukan Berupa Angka !!'
                ]
            ],
            'jumlah_berat_kp_kg' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Jumlah Berat Konsumsi Lokal !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_kepala_keluarga_kp_kk' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Jumlah Konsumsi KK !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_orang_kp' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Jumlah Konsumsi Orang !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_berat_dibagikan_stunting_kg' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Total Berat Dibagikan !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_kepala_keluarga_dibagikan_stunting' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Total Kepala Keluarga Dibagikan !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_orang_dibagikan_stunting' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Total Orang Dibagikan !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_berat_dibagikan_mm_kg' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Total Berat Dibagikan !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_kepala_keluarga_dibagikan_mm' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Total Kepala Keluarga Dibagikan !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_orang_dibagikan_mm' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Total Orang Dibagikan !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_berat_dibagikan_lansia_kg' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Total Berat Dibagikan !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_kepala_keluarga_dibagikan_lansia' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Total Kepala Keluarga Dibagikan !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_orang_dibagikan_lansia' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Total Orang Dibagikan !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_berat_dibagikan_posyandu_kg' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Total Berat Dibagikan !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_kepala_keluarga_dibagikan_posyandu' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Total Kepala Keluarga Dibagikan !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_orang_dibagikan_posyandu' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Total Orang Dibagikan !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_berat_dijual_kg' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Total Berat Dijual !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_orang_dijual' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Total Orang Dijual !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'harga_jual' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Masukkan Total Harga Penjualan !!',
                    'numeric' => 'Masukan Harus Berupa Angka !!'
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // Jika validasi sukses

            // Ambil file gambar
            $fileGambar = $this->request->getFile('gambar');
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('asset', $namaGambar);

            // Simpan data produksi
            $this->dataOlahanHasilModel->save([
                'id_data_olahan_hasil' => $id_data_olahan_hasil,
                'waktu_panen' => $this->request->getVar('waktu_jual'),
                'jumlah_panen' => $this->request->getVar('jumlah_panen'),
                'jumlah_berat_kp_kg' => $this->request->getVar('jumlah_berat_kp_kg'),
                'jumlah_kepala_keluarga_kp_kk' => $this->request->getVar('jumlah_kepala_keluarga_kp_kk'),
                'jumlah_orang_kp' => $this->request->getVar('jumlah_orang_kp'),
                'jumlah_berat_dibagikan_stunting_kg' => $this->request->getVar('jumlah_berat_dibagikan_stunting_kg'),
                'jumlah_kepala_keluarga_dibagikan_stunting' => $this->request->getVar('jumlah_kepala_keluarga_dibagikan_stunting'),
                'jumlah_orang_dibagikan_stunting' => $this->request->getVar('jumlah_orang_dibagikan_stunting'),
                'jumlah_berat_dibagikan_mm_kg' => $this->request->getVar('jumlah_berat_dibagikan_mm_kg'),
                'jumlah_kepala_keluarga_dibagikan_mm' => $this->request->getVar('jumlah_kepala_keluarga_dibagikan_mm'),
                'jumlah_orang_dibagikan_mm' => $this->request->getVar('jumlah_orang_dibagikan_mm'),
                'jumlah_berat_dibagikan_lansia_kg' => $this->request->getVar('jumlah_berat_dibagikan_lansia_kg'),
                'jumlah_kepala_keluarga_dibagikan_lansia' => $this->request->getVar('jumlah_kepala_keluarga_dibagikan_lansia'),
                'jumlah_orang_dibagikan_lansia' => $this->request->getVar('jumlah_orang_dibagikan_lansia'),
                'jumlah_berat_dibagikan_posyandu_kg' => $this->request->getVar('jumlah_berat_dibagikan_posyandu_kg'),
                'jumlah_kepala_keluarga_dibagikan_posyandu' => $this->request->getVar('jumlah_kepala_keluarga_dibagikan_posyandu'),
                'jumlah_orang_dibagikan_posyandu' => $this->request->getVar('jumlah_orang_dibagikan_posyandu'),
                'jumlah_berat_dijual_kg' => $this->request->getVar('jumlah_berat_dijual_kg'),
                'jumlah_kepala_keluarga_dijual_kk' => $this->request->getVar('jumlah_kepala_keluarga_dijual_kk'),
                'jumlah_orang_dijual' => $this->request->getVar('jumlah_orang_dijual'),
                'harga_jual' => $this->request->getVar('harga_jual'),
                'gambar' => $namaGambar
            ]);

            // Set flash data sukses
            session()->setFlashdata('pesan', 'Data hasil produksi berhasil disimpan.');

            // Redirect ke halaman lain atau tampilkan pesan sukses
            return redirect()->to('/dataOlahanHasil');
        } else {
            // Jika validasi gagal
            $validation = \Config\Services::validation();
            return redirect()->to('/dataOlahanHasil/dataProduksi/' . $id_data_olahan_hasil)->withInput()->with('validation', $validation);
        }
    }
}
