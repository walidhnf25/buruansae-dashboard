<?php

namespace App\Controllers;

use App\Models\dataSayurModel;

class DataSayur extends BaseController
{
    protected $dataSayurModel;
    public function __construct()
    {
        $this->dataSayurModel = new dataSayurModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_data_sayur') ? $this->request->getVar('page_data_sayur') : 1;

        $data = [
            'tittle' => 'Data Sayur | Buruan SAE',
            'data_sayur' => $this->dataSayurModel->getDataSayur(),
            'data_sayur' => $this->dataSayurModel->paginate(10, 'data_sayur'),
            'pager' => $this->dataSayurModel->pager,
            'currentPage' => $currentPage,
            'validation' => \Config\Services::validation()
        ];

        return view('pages/dataSayur', $data);
    }

    public function tambahDataSayur()
    {
        $data = [
            'tittle' => 'Data Sayur | Buruan SAE',
            'validation' => \Config\Services::validation(),
        ];
        return view('pages/tambahDataSayur', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'nama_sayur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih sayur terlebih dahulu'
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
                    'required' => 'Pilih kategori tumbuhan'
                ]
            ],
            'jumlah_tanam' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah sayur yang ditanam',
                    'numeric' => 'Masukan berupa angka'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataSayur/tambahDataSayur')->withInput()->with('validation', $validation);
        }

        $this->dataSayurModel->save([
            'nama_sayur' => $this->request->getVar('nama_sayur'),
            'tanggal_tanam' => $this->request->getVar('tanggal_tanam'),
            'kategori_tumbuhan' => $this->request->getVar('kategori_tumbuhan'),
            'jumlah_tanam' => $this->request->getVar('jumlah_tanam')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/dataSayur');
    }

    public function delete($id_sayur)
    {
        $sayur = $this->dataSayurModel->find($id_sayur);
        // unlink('../asset/' . $sayur['gambar']);
        $this->dataSayurModel->delete($id_sayur);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/dataSayur');
    }

    public function editDataSayur($id_sayur)
    {
        $data = [
            'tittle' => 'Data Sayur | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'sayur' => $this->dataSayurModel->getDataSayur($id_sayur)
        ];

        return view('pages/editDataSayur', $data);
    }

    public function update($id_sayur)
    {
        if (!$this->validate([
            'nama_sayur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih sayur'
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
                    'required' => 'Pilih kategori tumbuhan'
                ]
            ],
            'jumlah_tanam' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah sayur yang ditanam',
                    'numeric' => 'Masukan berupa angka'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataSayur/editDataSayur/' . $id_sayur)->withInput()->with('validation', $validation);
        }

        $data = [
            'nama_sayur' => $this->request->getVar('nama_sayur'),
            'tanggal_tanam' => $this->request->getVar('tanggal_tanam'),
            'kategori_tumbuhan' => $this->request->getVar('kategori_tumbuhan'),
            'jumlah_tanam' => $this->request->getVar('jumlah_tanam')
        ];

        // Update data berdasarkan id_sayur
        $this->dataSayurModel->update($id_sayur, $data);

        session()->setFlashdata('pesan', 'Data Sayur berhasil diubah.');

        return redirect()->to('/dataSayur');
    }


    public function dataPanenSayur($id_sayur)
    {
        session();
        $data = [
            'tittle' => 'Data Sayur | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'id_sayur' => $this->dataSayurModel->getDataSayur($id_sayur)
        ];
        return view('pages/dataPanenSayur', $data);
    }

    public function updateDataPanen($id_sayur)
    {

        if (!$this->validate([
            'waktu_panen' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Panen Harus Diisi !!'
                ]
            ],
            'jumlah_panen' => [
                'rules' => 'required|numeric[id_sayur.jumlah_panen]',
                'errors' => [
                    'required' => 'Masukkan Jumlah Panen !!',
                    'numeric' => 'Masukan Berupa Angka !!'
                ]
            ],
            'konsumsi_lokal_kg' => [
                'rules' => 'required|numeric[id_sayur.konsumsi_lokal_kg]',
                'errors' => [
                    'required' => 'Masukkan Jumlah Konsumsi Lokal !!',
                    'numeric' => 'Masukan arus berupa angka !!'
                ]
            ],
            'konsumsi_kk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => ' Masukkan Jumlah Konsumsi KK !!',
                    'numeric' => 'Masukan Harus Berupa Ankga !!'
                ]
            ],
            'konsumsi_orang' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Masukkan Jumlah Konsumsi Orang !!',
                    'numeric' => ' Masukan Harus Berupa Angka'
                ]
            ],
            'jumlah_jual' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Masukkan Jumlah Penjualan !!',
                    'numeric' => 'Masukan Harus Berupa Angka !!'
                ]
            ],
            'harga_jual' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Masukkan Total Harga Penjualan !!',
                    'numeric' => 'Masukan Harus Berupa Angka !!'
                ]
            ],
            'lokasi_pembeli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Lokasi Pembeli !!'
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih Gambar Terlebih Dahulu',
                    'max_size' => 'Ukuran Gambar Terlalu Besar, (MAX 2MB)',
                    'is_image' => 'Inputan Harus Berupa Gambar',
                    'mime_in' => 'Inputan Harus Berupa File'
                ]
            ],
            'dukungan_program_lain' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Dukungan Program Lainnya !!'
                ]
            ],
            'data_pendukung' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Data Pendukung !!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('dataSayur/dataPanenSayur/' . $this->request->getVar('id_sayur'))->withInput()->with('validation', $validation);
        }

        // ambil gambar
        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('asset', $namaGambar);

        $this->dataSayurModel->save([
            'id_sayur' => $id_sayur,
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

        return redirect()->to('/dataSayur');
    }
}
