<?php

namespace App\Controllers;

use App\Models\dataBuahModel;
use App\Models\dataKelompokModel;
use App\Models\DataKomoditiModel;



class DataBuah extends BaseController
{
    protected $dataBuahModel;
    protected $dataKelompokModel;
    protected $dataKomoditiModel;
    public function __construct()
    {
        $this->dataBuahModel = new dataBuahModel();
        $this->dataKelompokModel = new dataKelompokModel();
        $this->dataKomoditiModel = new DataKomoditiModel();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Data Buah | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'data_buah' => $this->dataBuahModel->getDataBuah()
        ];

        return view('pages/dataBuah', $data);
    }

    public function tambahDataBuah()
    {
        $data = [
            'tittle' => 'Data Buah | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'buah' => $this->dataBuahModel->getDataBuah(),
            'kelompok' => $this->dataKelompokModel->getDataKelompok(),
            'komoditi' => $this->dataKomoditiModel->where('sektor', 'BUAH')->findAll()
        ];
        return view('pages/tambahDataBuah', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'nama_buah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih buah'
                ]
            ],
            'tanggal_tanam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
            'kategori_tumbuhan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih salah satu kategori tumbuhan'
                ]
            ],
            'jumlah_tanam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan jumlah pohon buah yang ditanam'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataBuah/tambahDataBuah')->withInput()->with('validation', $validation);
        }

        $this->dataBuahModel->save([
            'nama_buah' => $this->request->getVar('nama_buah'),
            'id_kelompok' => $this->request->getVar('id_kelompok'),
            'tanggal_tanam' => $this->request->getVar('tanggal_tanam'),
            'kategori_tumbuhan' => $this->request->getVar('kategori_tumbuhan'),
            'jumlah_tanam' => $this->request->getVar('jumlah_tanam')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/dataBuah');
    }

    public function delete($id_buah)
    {
        $this->dataBuahModel->delete($id_buah);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/dataBuah');
    }

    public function editBuah($id_buah)
    {
        $data = [
            'tittle' => 'Data Buah | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'buah' => $this->dataBuahModel->getDataBuah($id_buah),
            'kelompok' => $this->dataKelompokModel->getDataKelompok(),
            'komoditi' => $this->dataKomoditiModel->where('sektor', 'BUAH')->findAll()
        ];

        return view('pages/editDataBuah', $data);
    }

    public function update($id_buah)
    {
        if (!$this->validate([
            'nama_buah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Buah'
                ]
            ],
            'tanggal_tanam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
            'kategori_tumbuhan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih salah satu kategori tumbuhan'
                ]
            ],
            'jumlah_tanam' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah pohon yang ditanam',
                    'numeric' => 'Masukan berupa angka'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataBuah' . $this->request->getVar('id_buah'))->withInput()->with('validation', $validation);
        }

        $this->dataBuahModel->save([
            'id_buah' => $id_buah,
            'nama_buah' => $this->request->getVar('nama_buah'),
            'id_kelompok' => $this->request->getVar('id_kelompok'),
            'tanggal_tanam' => $this->request->getVar('tanggal_tanam'),
            'kategori_tumbuhan' => $this->request->getVar('kategori_tumbuhan'),
            'jumlah_tanam' => $this->request->getVar('jumlah_tanam')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/dataBuah');
    }

    public function dataPanenBuah($id_buah)
    {
        $data = [
            'tittle' => 'Data Buah | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'buah' => $this->dataBuahModel->getDataBuah($id_buah)
        ];
        return view('pages/dataPanenBuah', $data);
    }

    public function tambah_data_panen($id_buah)
    {
        // helper('textarea');
        // dd($this->request->getVar());
        if (!$this->validate([
            'waktu_pupuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
            'jenis_pupuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
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
            'jumlah_pupuk' => [
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
            $validation = \Config\Services::validation();
            return redirect()->to('/dataBuah/dataPanenBuah/' . $this->request->getVar('id_buah'))->withInput()->with('validation', $validation);
            // return redirect()->to('/dataBuah/' . $this->request->getVar('id_buah'))->withInput();
        }

        // ambil gambar
        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('asset', $namaGambar);

        $this->dataBuahModel->save([
            'id_buah' => $id_buah,
            'waktu_panen' => $this->request->getVar('waktu_panen'),
            'waktu_pupuk' => $this->request->getVar('waktu_pupuk'),
            'jenis_pupuk' => $this->request->getVar('jenis_pupuk'),
            'jumlah_panen' => $this->request->getVar('jumlah_panen'),
            'jumlah_pupuk' => $this->request->getVar('jumlah_pupuk'),
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

        session()->setFlashdata('pesan', 'Data panen berhasil disimpan.');

        return redirect()->to('/dataBuah');
    }
}
