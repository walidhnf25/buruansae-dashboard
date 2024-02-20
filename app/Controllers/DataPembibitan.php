<?php

namespace App\Controllers;

use App\Models\dataPembibitanModel;

class DataPembibitan extends BaseController
{
    protected $dataPembibitanModel;
    public function __construct()
    {
        $this->dataPembibitanModel = new dataPembibitanModel();
    }

    public function index()
    {

        $currentPage = $this->request->getVar('page_data_ternak') ? $this->request->getVar('page_data_ternak') : 1;

        $data = [
            'tittle' => 'Data Pembibitan | Buruan SAE',
            'data_pembibitan' => $this->dataPembibitanModel->paginate(10, 'data_pembibitan'),
            'validation' => \Config\Services::validation(),
            'pager' => $this->dataPembibitanModel->pager,
            'currentPage' => $currentPage
        ];

        return view('pages/DataPembibitan', $data);
    }

    public function tambahDataPembibitan()
    {
        $data = [
            'tittle' => 'Tambah Data Pembibitan | Buruan SAE',
            'validation' => \Config\Services::validation(),
        ];
        return view('pages/tambahDataPembibitan', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'kategori_pembibitan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih kategori pembibitan'
                ]
            ],
            'tanggal_pembibitan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
            'tipe_tumbuhan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih kategori pembibitan'
                ]
            ],
            'jumlah_pembibitan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan jumlah bibit yang ditanam'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/DataPembibitan/tambahDataPembibitan')->withInput()->with('validation', $validation);
        }

        $this->dataPembibitanModel->save([
            'tipe_tumbuhan' => $this->request->getVar('tipe_tumbuhan'),
            'tanggal_pembibitan' => $this->request->getVar('tanggal_pembibitan'),
            'kategori_pembibitan' => $this->request->getVar('kategori_pembibitan'),
            'jumlah_pembibitan' => $this->request->getVar('jumlah_pembibitan')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/dataPembibitan');
    }

    public function delete($id_bibit)
    {
        $this->dataPembibitanModel->delete($id_bibit);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/dataPembibitan');
    }

    public function edit($id_bibit)
    {
        $data = [
            'tittle' => 'Data Pembibitan | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'bibit' => $this->dataPembibitanModel->getDataPembibitanModel($id_bibit)
        ];

        return view('pages/dataPembibitan', $data);
    }

    public function editDataPembibitan($id_bibit)
    {
        $data = [
            'tittle' => 'Edit Data Pembibitan | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'bibit' => $this->dataPembibitanModel->getDataPembibitan($id_bibit)
        ];

        return view('pages/editDataPembibitan', $data);
    }

    public function update($id_bibit)
    {
        // validasi input
        if (!$this->validate([
            'kategori_pembibitan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih kategori pembibitan'
                ]
            ],
            'tanggal_pembibitan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
            'tipe_tumbuhan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih kategori pembibitan'
                ]
            ],
            'jumlah_pembibitan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan jumlah bibit yang ditanam'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataPembibitan/editDataPembibitan/' . $this->request->getVar('id_bibit'))->withInput()->with('validation', $validation);
        }

        $this->dataPembibitanModel->save([
            'id_bibit' => $id_bibit,
            'tipe_tumbuhan' => $this->request->getVar('tipe_tumbuhan'),
            'tanggal_pembibitan' => $this->request->getVar('tanggal_pembibitan'),
            'kategori_pembibitan' => $this->request->getVar('kategori_pembibitan'),
            'jumlah_pembibitan' => $this->request->getVar('jumlah_pembibitan')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/dataPembibitan');
    }

    public function dataPanenPembibitan($id_bibit)
    {
        $data = [
            'tittle' => 'Data Panen Pembibitan | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'bibit' => $this->dataPembibitanModel->getDataPembibitan($id_bibit)
        ];
        return view('pages/dataPanenPembibitan', $data);
    }

    public function tambah_data_panen($id_bibit)
    {
        // helper('textarea');
        // dd($this->request->getVar());
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
            return redirect()->to('/dataPembibitan/dataPanenPembibitan/' . $this->request->getVar('id_bibit'))->withInput()->with('validation', $validation);
            // return redirect()->to('/dataPembibitan/dataPanenPembibitan' . $this->request->getVar('id_bibit'))->withInput();
        }

        // ambil gambar
        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('asset', $namaGambar);

        $this->dataPembibitanModel->save([
            'id_bibit' => $id_bibit,
            'waktu_panen' => $this->request->getVar('waktu_panen'),
            'jumlah_panen' => $this->request->getVar('jumlah_panen'),
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

        return redirect()->to('/dataPembibitan');
    }
}
