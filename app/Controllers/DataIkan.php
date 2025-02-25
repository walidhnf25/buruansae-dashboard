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
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // Ambil filter dari query string (GET parameter)
        $filter = $this->request->getGet('filter');

        $data = [
            'tittle' => 'Data Ikan | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'data_ikan' => $this->dataIkanModel->getDataIkan(false, $filter), // Kirim filter ke model
            'komoditi' => $this->db->table('data_komoditi')->where('sektor', 'IKAN')->get()->getResultArray(),
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
            'jumlah_ikan' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah ikan',
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
                    'required' => 'Pilih Tanggal'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataIkan/tambahDataIkan')->withInput()->with('validation', $validation);
        }

        $this->dataIkanModel->save([
            'waktu_pakan' => $this->request->getVar('waktu_pakan'),
            'jenis_ikan' => $this->request->getVar('jenis_ikan'),
            'id_kelompok' => $this->request->getVar('id_kelompok'), // tambah ini
            'jumlah_ikan' => $this->request->getVar('jumlah_ikan'),
            'prakiraan_jumlah_panen' => $this->request->getVar('prakiraan_jumlah_panen'),
            'waktu_prakiraan_panen' => $this->request->getVar('waktu_prakiraan_panen')
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
        $ikan = $this->dataIkanModel->getDataIkan($id_ikan);

        // Ambil data `durasi_tanam` dari tabel `data_komoditi` berdasarkan nama buah
        $komoditi = $this->dataKomoditiModel->where('nama_komoditi', $ikan['jenis_ikan'])->first();
        $durasi_tanam = $komoditi['durasi_tanam'] ?? null;

        $data = [
            'tittle' => 'Edit Data Ikan | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'ikan' => $ikan,
            'durasi_tanam' => $durasi_tanam,
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
                    'required' => 'Pilih tanggal'
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
            'jumlah_ikan' => $this->request->getVar('jumlah_ikan'),
            'prakiraan_jumlah_panen' => $this->request->getVar('prakiraan_jumlah_panen'),
            'waktu_prakiraan_panen' => $this->request->getVar('waktu_prakiraan_panen')
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
            'jumlah_panen_kg' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah panen',
                    'numeric' => 'Masukkan angka'
                ]
            ],
            'jumlah_panen_ekor' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah panen',
                    'numeric' => 'Masukkan angka'
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
            return redirect()->to('/dataIkan/dataPanenIkan/' . $this->request->getVar('id_ikan'))->withInput()->with('validation', $validation);
            // return redirect()->to('/dataIkan/dataPanen' . $this->request->getVar('id_ikan'))->withInput();
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

        $this->dataIkanModel->save([
            'id_ikan' => $id_ikan,
            'waktu_panen' => $this->request->getVar('waktu_panen'),
            'jumlah_panen_kg' => $this->request->getVar('jumlah_panen_kg'),
            'jumlah_panen_ekor' => $this->request->getVar('jumlah_panen_ekor'),
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

        return redirect()->to('/dataIkan');
    }
}
