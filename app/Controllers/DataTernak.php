<?php

namespace App\Controllers;

use App\Models\dataTernakModel;

class DataTernak extends BaseController
{
    protected $dataTernakModel;
    public function __construct()
    {
        $this->dataTernakModel = new dataTernakModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_data_ternak') ? $this->request->getVar('page_data_ternak') : 1;

        $data = [
            'tittle' => 'Data Ternak | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'data_ternak' => $this->dataTernakModel->paginate(10, 'data_ternak'),
            'pager' => $this->dataTernakModel->pager,
            'currentPage' => $currentPage
        ];

        return view('pages/dataTernak', $data);
    }

    public function tambahDataTernak()
    {
        $data = [
            'tittle' => 'Data Ternak | Buruan SAE',
            'validation' => \Config\Services::validation(),
        ];
        return view('pages/tambahDataTernak', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'jenis_ternak' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih jenis ternak terlebih dahulu'
                ]
            ],
            'waktu_pakan' => [
                'rules' => 'required',
                "errors" => [
                    'required' => 'Pilih waktu pakan'
                ]
            ],
            'jumlah_pakan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan jumlah pakan'
                ]
            ],
            'jumlah_ternak' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah ternak',
                    'numeric' => 'Masukan berupa angka'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataTernak/tambahDataTernak')->with('validation', $validation);
        }

        $this->dataTernakModel->save([
            'jenis_ternak' => $this->request->getVar('jenis_ternak'),
            'waktu_pakan' => $this->request->getVar('waktu_pakan'),
            'jumlah_pakan' => $this->request->getVar('jumlah_pakan'),
            'jumlah_ternak' => $this->request->getVar('jumlah_ternak')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/dataTernak');
    }

    public function delete($id_ternak)
    {
        $ternak = $this->dataTernakModel->find($id_ternak);
        // unlink('asset/'.$ternak['gambar']);
        $this->dataTernakModel->delete($id_ternak);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/dataTernak');
    }

    public function editDataTernak($id_ternak)
    {
        $data = [
            'tittle' => 'Data Ternak | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'ternak' => $this->dataTernakModel->getDataTernak($id_ternak)
        ];

        return view('pages/editDataTernak', $data);
    }

    public function update($id_ternak)
    {
        if (!$this->validate([
            'jenis_ternak' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih jenis ternak'
                ]
            ],
            'waktu_pakan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
            'jumlah_ternak' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Isi jumlah ternak terlebih dahulu',
                    'numeric' => 'Masukan berupa angka'
                ]
            ],
            'jumlah_pakan' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Isi jumlah pakan ternak',
                    'numeric' => 'Masukan berupa angka'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataTernak/editDataTernak/' . $this->request->getVar('id_ternak'))->withInput()->with('validation', $validation);
        }

        $this->dataTernakModel->save([
            'id_ternak' => $id_ternak,
            'jenis_ternak' => $this->request->getVar('jenis_ternak'),
            'waktu_pakan' => $this->request->getVar('waktu_pakan'),
            'jumlah_pakan' => $this->request->getVar('jumlah_pakan'),
            'jumlah_ternak' => $this->request->getVar('jumlah_ternak')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/dataTernak');
    }

    public function dataPanenTernak($id_ternak)
    {
        $data = [
            'tittle' => 'Data Panen Ternak | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'id_ternak' => $this->dataTernakModel->getDataTernak($id_ternak)
        ];
        return view('pages/dataPanenTernak', $data);
    }

    public function tambah_data_panen($id_ternak)
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
            return redirect()->to('/dataTernak/dataPanenTernak/' . $this->request->getVar('id_ternak'))->withInput()->with('validation', $validation);
            // return redirect()->to('/dataTernak/dataPanenTernak/' . $id_ternak)->withInput()->with('validation', $validation);
        }

        // ambil gambar
        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('asset', $namaGambar);

        $this->dataTernakModel->save([
            'id_ternak' => $id_ternak,
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

        return redirect()->to('/dataTernak');
    }
}
