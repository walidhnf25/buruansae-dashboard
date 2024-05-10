<?php

namespace App\Controllers;

use App\Models\dataTanamanObatModel;
use App\Models\dataKelompokModel;
use App\Models\dataKomoditiModel;

class DataTanamanObat extends BaseController
{
    protected $dataTanamanObatModel;
    protected $dataKelompokModel;
    protected $dataKomoditiModel;
    public function __construct()
    {
        $this->dataTanamanObatModel = new dataTanamanObatModel();
        $this->dataKelompokModel = new dataKelompokModel();
        $this->dataKomoditiModel = new dataKomoditiModel();
    }

    public function index()
    {
        $data = [
            'tittle' => 'Data Tanaman Obat | Buruan SAE',
            // 'data_tanaman_obat' => $this->dataTanamanObatModel->getDataTanamanObat(),
            'validation' => \Config\Services::validation(),
            'data_tanaman_obat' => $this->dataTanamanObatModel->getDataTanamanObat(),
        ];

        return view('pages/dataTanamanObat', $data);
    }

    public function tambahDataTamananObat()
    {
        $data = [
            'tittle' => 'Data Tanaman Obat | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'obat' => $this->dataTanamanObatModel->getDataTanamanObat(),
            'kelompok' => $this->dataKelompokModel->getDataKelompok(),
            'komoditi' => $this->dataKomoditiModel->where('sektor', 'TANAMAN OBAT')->findAll()
        ];
        return view('pages/tambahDataTanamanObat', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'nama_tanaman_obat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanaman Obat terlebih dahulu'
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
                    'required' => 'Masukkan jumlah tanaman obat yang ditanam',
                    'numeric' => 'Masukan berupa angka'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataTanamanObat/tambahDataTamananObat')->withInput()->with('validation', $validation);
        }

        $this->dataTanamanObatModel->save([
            'nama_tanaman_obat' => $this->request->getVar('nama_tanaman_obat'),
            'id_kelompok' => $this->request->getVar('id_kelompok'),
            'tanggal_tanam' => $this->request->getVar('tanggal_tanam'),
            'kategori_tumbuhan' => $this->request->getVar('kategori_tumbuhan'),
            'jumlah_tanam' => $this->request->getVar('jumlah_tanam')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/dataTanamanObat');
    }

    public function delete($id_tanaman_obat)
    {
        $obat = $this->dataTanamanObatModel->find($id_tanaman_obat);
        $this->dataTanamanObatModel->delete($id_tanaman_obat);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/dataTanamanObat');
    }

    public function editDataTanamanObat($id_tanaman_obat)
    {
        $data = [
            'tittle' => 'Data Tanaman Obat | Buruan SAE',
            'obat' => $this->dataTanamanObatModel->getDataTanamanObat($id_tanaman_obat),
            'kelompok' => $this->dataKelompokModel->getDataKelompok(),
            'komoditi' => $this->dataKomoditiModel->where('sektor', 'TANAMAN OBAT')->findAll(),
            'validation' => \Config\Services::validation(),
        ];

        return view('pages/editDataTanamanObat', $data);
    }

    public function update($id_tanaman_obat)
    {
        if (!$this->validate([
            'nama_tanaman_obat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanaman obat'
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
                    'required' => 'Masukkan jumlah tanaman yang ditanam',
                    'numeric' => 'Masukan berupa angka'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataTanamanObat/editDataTanamanObat/' . $this->request->getVar('id_tanaman_obat'))->withInput()->with('validation', $validation);
        }

        $data = [
            'nama_tanaman_obat' => $this->request->getVar('nama_tanaman_obat'),
            'id_kelompok' => $this->request->getVar('id_kelompok'),
            'tanggal_tanam' => $this->request->getVar('tanggal_tanam'),
            'kategori_tumbuhan' => $this->request->getVar('kategori_tumbuhan'),
            'jumlah_tanam' => $this->request->getVar('jumlah_tanam')
        ];

        // Update Data Tanaman Obat
        $this->dataTanamanObatModel->update($id_tanaman_obat, $data);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/dataTanamanObat');
    }

    public function dataPanenTanamanObat($id_tanaman_obat)
    {
        $data = [
            'tittle' => 'Data Sayur | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'id_tanaman_obat' => $this->dataTanamanObatModel->getDataTanamanObat($id_tanaman_obat)
        ];
        return view('pages/dataPanenTanamanObat', $data);
    }

    public function updateDataPanen($id_tanaman_obat)
    {

        if (!$this->validate([
            'waktu_panen' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Panen Harus Diisi !!'
                ]
            ],
            'jumlah_panen' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Masukkan Jumlah Panen !!',
                    'numeric' => 'Masukan Berupa Angka !!'
                ]
            ],
            'konsumsi_lokal_kg' => [
                'rules' => 'required|numeric',
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
                'rules' => 'uploaded[gambar]|max_size[gambar,2048]|mime_in[gambar,image/jpg,image/jpeg,image/png]|is_image[gambar]',
                'errors' => [
                    // 'required' => 'Pilih Gambar Terlebih Dahulu !!',
                    'uploaded' => 'Pilih Gambar Terlebih Dahulu !!',
                    'max_size' => 'Ukuran Gambar Terlalu Besar (MAX 2MB)',
                    'mime_in' => 'Inputan Harus Berupa Gambar',
                    'is_image' => 'Inputan Harus Berupa Gambar',
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
            return redirect()->to('dataTanamanObat/dataPanenTanamanObat/' . $this->request->getVar('id_tanaman_obat'))->withInput()->with('validation', $validation);
        }

        // ambil gambar
        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('asset', $namaGambar);

        $this->dataTanamanObatModel->save([
            'id_tanaman_obat' => $id_tanaman_obat,
            'waktu_panen' => $this->request->getVar('waktu_panen'),
            'jumlah_panen' => $this->request->getVar('jumlah_panen'),
            'konsumsi_lokal_kg' => $this->request->getVar('konsumsi_lokal_kg'),
            'konsumsi_kk' => $this->request->getVar('konsumsi_kk'),
            'konsumsi_orang' => $this->request->getVar('konsumsi_orang'),
            'jumlah_jual' => $this->request->getVar('jumlah_jual'),
            'harga_jual' => $this->request->getVar('harga_jual'),
            'lokasi_pembeli' => $this->request->getVar('lokasi_pembeli'),
            'gambar' => $namaGambar,
            'dukungan_program_lain' => $this->request->getVar('dukungan_program_lain'),
            'data_pendukung' => $this->request->getVar('data_pendukung')
        ]);

        session()->setFlashdata('pesan', 'Data panen berhasil disimpan.');

        return redirect()->to('/dataTanamanObat');
    }
}
