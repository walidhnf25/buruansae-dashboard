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
    }

    public function index()
    {

        $data = [
            'tittle' => 'Data Olahan Hasil | Buruan SAE',
            'data_olahan_hasil' => $this->dataOlahanHasilModel->getDataOlahanHasil(),
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
            'waktu_jual' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
            'konsumsi_lokal_kg' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah konsumsi lokal',
                    'numeric' => 'Masukkan angka'
                ]
            ],
            'konsumsi_kk' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah konsumsi KK',
                    'numeric' => 'Masukkan angka'
                ]
            ],
            'konsumsi_orang' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah konsumsi orang',
                    'numeric' => 'Masukkan angka'
                ]
            ],
            'jumlah_jual' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah jumlah penjualan',
                    'numeric' => 'Masukkan angka'
                ]
            ],
            'harga_jual' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan total harga penjualan',
                    'numeric' => 'Masukkan angka'
                ]
            ],
            'lokasi_pembeli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan lokasi pembeli'
                ]
            ],
            'dukungan_program_lain' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan dukungan program lainnya'
                ]
            ],
            'data_pendukung' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan data pendukung'
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
                'waktu_jual' => $this->request->getVar('waktu_jual'),
                'konsumsi_lokal_kg' => $this->request->getVar('konsumsi_lokal_kg'),
                'konsumsi_kk' => $this->request->getVar('konsumsi_kk'),
                'konsumsi_orang' => $this->request->getVar('konsumsi_orang'),
                'jumlah_jual' => $this->request->getVar('jumlah_jual'),
                'harga_jual' => $this->request->getVar('harga_jual'),
                'lokasi_pembeli' => $this->request->getVar('lokasi_pembeli'),
                'dukungan_program_lain' => $this->request->getVar('dukungan_program_lain'),
                'data_pendukung' => $this->request->getVar('data_pendukung'),
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
