<?php

namespace App\Controllers;

use App\Models\dataPengolahanSampahModel;

class DataPengolahanSampah extends BaseController
{
    protected $dataPengolahanSampahModel;
    public function __construct()
    {
        $this->dataPengolahanSampahModel = new dataPengolahanSampahModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_data_sampah') ? $this->request->getVar('page_data_sampah') : 1;

        $data = [
            'tittle' => 'Data Pengolahan Sampah | Buruan SAE',
            'data_sampah' => $this->dataPengolahanSampahModel->paginate(10, 'data_sampah'),
            'validation' => \Config\Services::validation(),
            'pager' => $this->dataPengolahanSampahModel->pager,
            'currentPage' => $currentPage
        ];

        return view('pages/dataPengolahanSampah', $data);
    }

    public function tambahDataSampah()
    {
        $data = [
            'tittle' => 'Data Sampah | Buruan SAE',
            'validation' => \Config\Services::validation()
        ];
        return view('pages/tambahDataSampah', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'tanggal_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
            'jenis_pengolahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan jenis pengolahan sampah'
                ]
            ],
            'jumlah_sampah' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah sampah',
                    'numeric' => 'Masukan berupa angka'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataPengolahanSampah/tambahDataSampah')->withInput()->with('validation', $validation);
        }

        $this->dataPengolahanSampahModel->save([
            'tanggal_masuk' => $this->request->getVar('tanggal_masuk'),
            'jenis_pengolahan' => $this->request->getVar('jenis_pengolahan'),
            'jumlah_sampah' => $this->request->getVar('jumlah_sampah')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/dataPengolahanSampah');
    }

    public function delete($id_data_sampah)
    {
        $this->dataPengolahanSampahModel->delete($id_data_sampah);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/dataPengolahanSampah');
    }

    public function editDataSampah($id_data_sampah)
    {
        $data = [
            'tittle' => 'Data Sampah | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'sampah' => $this->dataPengolahanSampahModel->getDataSampah($id_data_sampah)
        ];

        return view('pages/editDataSampah', $data);
    }

    public function update($id_data_sampah)
    {
        // validasi input
        if (!$this->validate([
            'tanggal_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
            'jenis_pengolahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan jenis pengolahan sampah'
                ]
            ],
            'jumlah_sampah' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah sampah',
                    'numeric' => 'Masukan berupa angka'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataPengolahanSampah/editDataSampah' . $this->request->getVar('id_data_sampah'))->withInput()->with('validation', $validation);
        }

        $this->dataPengolahanSampahModel->save([
            'id_data_sampah' => $id_data_sampah,
            'tanggal_masuk' => $this->request->getVar('tanggal_masuk'),
            'jenis_pengolahan' => $this->request->getVar('jenis_pengolahan'),
            'jumlah_sampah' => $this->request->getVar('jumlah_sampah')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/dataPengolahanSampah');
    }


    public function dataProduksiSampah($id_data_sampah)
    {
        $data = [
            'tittle' => 'Data Sampah | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'id_data_sampah' => $this->dataPengolahanSampahModel->getDataSampah($id_data_sampah),
        ];
        return view('pages/dataProduksiSampah', $data);
    }

    public function tambah_data_panen($id_data_sampah)
    {
        // helper('textarea');
        // dd($this->request->getVar());
        if (!$this->validate([
            'waktu_sebaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
            'produk_hasil' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan jumlah panen',
                ]
            ],
            'penggunaan_lokal' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah konsumsi lokal',
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
            'program_pendukung' => [
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
            $validation = \Config\Services::validation();
            return redirect()->to('/dataPengolahanSampah/dataProduksiSampah/' . $id_data_sampah)->withInput()->with('validation', $validation);
            // return redirect()->to('/dataPengolahanSampah/dataProduksiSampah/' . $this->request->getVar('id_data_sampah'))->withInput();
        }

        // ambil gambar
        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('asset', $namaGambar);

        $this->dataPengolahanSampahModel->save([
            'id_data_sampah' => $id_data_sampah,
            'waktu_sebaran' => $this->request->getVar('waktu_sebaran'),
            'produk_hasil' => $this->request->getVar('produk_hasil'),
            'penggunaan_lokal' => $this->request->getVar('penggunaan_lokal'),
            'jumlah_jual' => $this->request->getVar('jumlah_jual'),
            'harga_jual' => $this->request->getVar('harga_jual'),
            'lokasi_pembeli' => $this->request->getVar('lokasi_pembeli'),
            'dukungan_program_lain' => $this->request->getVar('dukungan_program_lain'),
            'program_pendukung' => $this->request->getVar('program_pendukung'),
            'gambar' => $namaGambar
        ]);

        session()->setFlashdata('pesan', 'Data panen berhasil disimpan.');

        return redirect()->to('/dataPengolahanSampah');
    }
}
