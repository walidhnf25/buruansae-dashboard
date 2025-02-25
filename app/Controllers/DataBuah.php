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
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // Ambil filter dari query string (GET parameter)
        $filter = $this->request->getGet('filter');

        $data = [
            'tittle' => 'Data Buah | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'data_buah' => $this->dataBuahModel->getDataBuah(false, $filter)
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
            ],
            'prakiraan_jumlah_panen' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan prakiraan jumlah panen yang dihasilkan',
                    'decimal' => 'Masukan berupa angka'
                ]
            ],
            'waktu_prakiraan_panen' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Maukkan Tanggal Waktu Prakiran Panen'
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
            'jumlah_tanam' => $this->request->getVar('jumlah_tanam'),
            'prakiraan_jumlah_panen' => $this->request->getVar('prakiraan_jumlah_panen'),
            'waktu_prakiraan_panen' => $this->request->getVar('waktu_prakiraan_panen')
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
        $buah = $this->dataBuahModel->getDataBuah($id_buah);

        // Ambil data `durasi_tanam` dari tabel `data_komoditi` berdasarkan nama buah
        $komoditi = $this->dataKomoditiModel->where('nama_komoditi', $buah['nama_buah'])->first();
        $durasi_tanam = $komoditi['durasi_tanam'] ?? null;

        $data = [
            'tittle' => 'Data Buah | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'buah' => $buah,
            'durasi_tanam' => $durasi_tanam,
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
            ],
            'prakiraan_jumlah_panen' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan prakiraan jumlah panen yang dihasilkan',
                    'decimal' => 'Masukan berupa angka'
                ]
            ],
            'waktu_prakiraan_panen' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Maukkan Tanggal Waktu Prakiran Panen'
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
            'jumlah_tanam' => $this->request->getVar('jumlah_tanam'),
            'prakiraan_jumlah_panen' => $this->request->getVar('prakiraan_jumlah_panen'),
            'waktu_prakiraan_panen' => $this->request->getVar('waktu_prakiraan_panen')
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
            'jumlah_pupuk' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah panen',
                    'numeric' => 'Masukkan angka'
                ]
            ],
            'jumlah_panen' => [
                'rules' => 'required|numeric[id_buah.jumlah_panen]',
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
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan total harga penjualan',
                    'numeric' => 'Masukkan angka'
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

        $fileGambar = $this->request->getFile('gambar');

        // Jika ukuran gambar lebih dari 3 MB, kompres gambar
        $maxSize = 3 * 1024 * 1024; // 3 MB dalam byte
        if ($fileGambar->getSize() > $maxSize) {
            // Buat nama baru untuk gambar
            $namaGambar = $fileGambar->getRandomName();

            // Kompres gambar menggunakan Intervention Image
            $image = Image::make($fileGambar->getTempName());
            $image->resize(1920, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->save('asset/' . $namaGambar, 80); // Simpan dengan kualitas 80

        } else {
            // Jika ukuran gambar sudah sesuai, langsung pindahkan
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('asset', $namaGambar);
        }

        $this->dataBuahModel->save([
            'id_buah' => $id_buah,
            'waktu_panen' => $this->request->getVar('waktu_panen'),
            'waktu_pupuk' => $this->request->getVar('waktu_pupuk'),
            'jenis_pupuk' => $this->request->getVar('jenis_pupuk'),
            'jumlah_panen' => $this->request->getVar('jumlah_panen'),
            'jumlah_pupuk' => $this->request->getVar('jumlah_pupuk'),
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

        session()->setFlashdata('pesan', 'Data panen berhasil disimpan.');

        return redirect()->to('/dataBuah');
    }
}
