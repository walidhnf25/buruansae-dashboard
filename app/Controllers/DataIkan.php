<?php

namespace App\Controllers;

use App\Models\dataIkanModel;
use App\Models\dataKelompokModel;
use App\Models\DataKomoditiModel;


class DataIkan extends BaseController
{
    protected $dataIkanModel;
    protected $dataKelompokModel;
    protected $dataKomoditiModel;

    public function __construct()
    {
        $this->dataIkanModel = new dataIkanModel();
        $this->dataKelompokModel = new dataKelompokModel();
        $this->dataKomoditiModel = new DataKomoditiModel();
    }

    public function index()
    {
        $data = [
            'tittle' => 'Data Ikan | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'data_ikan' => $this->dataIkanModel->getDataIkan()
        ];

        return view('pages/dataIkan', $data);
    }

    public function tambahDataIkan()
    {
        $data = [
            'tittle' => 'Data Ikan | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'ikan' => $this->dataIkanModel->getDataIkan(),
            'kelompok' => $this->dataKelompokModel->getDataKelompok(),
            'komoditi' => $this->dataKomoditiModel->where('sektor', 'IKAN')->findAll()
        ];
        return view('pages/tambahDataIkan', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'waktu_pakan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Tanggal'
                ]
            ],
            'jenis_ikan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan jenis ikan'
                ]
            ],
            'jumlah_pakan' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah pakan',
                    'numeric' => 'Masukan berupa angka'
                ]
            ],
            'jumlah_ikan' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah ikan',
                    'numeric' => 'Masukan berupa angka'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataIkan/tambahDataIkan')->withInput()->with('validation', $validation);
        }

        $this->dataIkanModel->save([
            'waktu_pakan' => $this->request->getVar('waktu_pakan'),
            'jenis_ikan' => $this->request->getVar('jenis_ikan'),
            'id_kelompok' => $this->request->getVar('id_kelompok'), // tambah ini
            'jumlah_pakan' => $this->request->getVar('jumlah_pakan'),
            'jumlah_ikan' => $this->request->getVar('jumlah_ikan')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/dataIkan');
    }

    public function delete($id_ikan)
    {
        $this->dataIkanModel->delete($id_ikan);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/dataIkan');
    }

    public function editDataIkan($id_ikan)
    {
        $data = [
            'tittle' => 'Edit Data Ikan | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'ikan' => $this->dataIkanModel->getDataIkan($id_ikan),
            'kelompok' => $this->dataKelompokModel->getDataKelompok(),
            'komoditi' => $this->dataKomoditiModel->where('sektor', 'IKAN')->findAll()
        ];

        return view('pages/editDataIkan', $data);
    }

    public function update($id_ikan)
    {
        if (!$this->validate([
            'jenis_ikan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih jenis ikan'
                ]
            ],
            'waktu_pakan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
            'jumlah_ikan' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Pilih salah satu kategori tumbuhan',
                    'numeric' => 'Masukan berupa angka'
                ]
            ],
            'jumlah_pakan' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah ikan yang ditanam',
                    'numeric' => 'Masukan berupa angka'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataIkan/editDataIkan/' . $this->request->getVar('id_ikan'))->withInput()->with('validation', $validation);
        }

        $this->dataIkanModel->save([
            'id_ikan' => $id_ikan,
            'jenis_ikan' => $this->request->getVar('jenis_ikan'),
            'id_kelompok' => $this->request->getVar('id_kelompok'), // tambah ini
            'waktu_pakan' => $this->request->getVar('waktu_pakan'),
            'jumlah_pakan' => $this->request->getVar('jumlah_pakan'),
            'jumlah_ikan' => $this->request->getVar('jumlah_ikan')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/dataIkan');
    }

    public function dataPanenIkan($id_ikan)
    {
        $data = [
            'tittle' => 'Data Ikan | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'id_ikan' => $this->dataIkanModel->getDataIkan($id_ikan)
        ];
        return view('pages/dataPanenIkan', $data);
    }

    public function tambah_data_panen($id_ikan)
    {
        if (!$this->validate([
            'waktu_panen' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
            'jumlah_panen' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah panen',
                    'numeric' => 'Masukkan angka'
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
            $validation = \Config\Services::validation();
            return redirect()->to('/dataIkan/dataPanenIkan/' . $this->request->getVar('id_ikan'))->withInput()->with('validation', $validation);
            // return redirect()->to('/dataIkan/dataPanen' . $this->request->getVar('id_ikan'))->withInput();
        }

        // ambil gambar
        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('asset', $namaGambar);

        $this->dataIkanModel->save([
            'id_ikan' => $id_ikan,
            'waktu_panen' => $this->request->getVar('waktu_panen'),
            'jumlah_panen' => $this->request->getVar('jumlah_panen'),
            'konsumsi_lokal_kg' => $this->request->getVar('konsumsi_lokal_kg'),
            'konsumsi_kk' => $this->request->getVar('konsumsi_kk'),
            'konsumsi_orang' => $this->request->getVar('konsumsi_orang'),
            'jumlah_jual' => $this->request->getVar('jumlah_jual'),
            'harga_jual' => $this->request->getVar('harga_jual'),
            'lokasi_pembeli' => $this->request->getVar('lokasi_pembeli'),
            'gambar' => $namaGambar
        ]);

        session()->setFlashdata('pesan', 'Data panen berhasil disimpan.');

        return redirect()->to('/dataIkan');
    }
}
