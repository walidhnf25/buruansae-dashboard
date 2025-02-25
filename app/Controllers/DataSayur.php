<?php

namespace App\Controllers;

use App\Models\dataSayurModel;
use App\Models\dataKelompokModel;
use App\Models\DataKomoditiModel;

class DataSayur extends BaseController
{
    protected $dataSayurModel;
    protected $dataKelompokModel;
    protected $dataKomoditiModel;

    public function __construct()
    {
        $this->dataSayurModel = new dataSayurModel();
        $this->dataKelompokModel = new dataKelompokModel();
        $this->dataKomoditiModel = new DataKomoditiModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // Ambil filter dari query string (GET parameter)
        $filter = $this->request->getGet('filter');

        $data = [
            'tittle' => 'Data Sayur | Buruan SAE',
            'data_sayur' => $this->dataSayurModel->getDataSayur(false, $filter),
            'komoditi' => $this->db->table('data_komoditi')->get()->getResultArray(),
            'filter' => $filter,
            'validation' => \Config\Services::validation()
        ];

        return view('pages/dataSayur', $data);
    }

    public function tambahDataSayur()
    {
        $data = [
            'tittle' => 'Data Sayur | Buruan SAE',
            // 'nama_kelompok' => $this->dataSayurModel->getUniqueNamaKelompok(), // Fetch unique nama_kelompok values
            'data_sayur' => $this->dataSayurModel->getDataSayur(),
            'kelompok' => $this->dataKelompokModel->getDataKelompok(),
            'komoditi' => $this->dataKomoditiModel->where('sektor', 'SAYUR')->findAll(),
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
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah sayur yang ditanam',
                    'numeric' => 'Masukan berupa angka'
                ]
            ],
            'prakiraan_jumlah_panen' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan prakiraan jumlah panen yang dihasilkan',
                    'decimal' => 'Masukan berupa angka'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataSayur/tambahDataSayur')->withInput()->with('validation', $validation);
        }

        // Ambil data durasi tanam dari tabel data_komoditi
        $nama_sayur = $this->request->getVar('nama_sayur');
        $tanggal_tanam = $this->request->getVar('tanggal_tanam');
        $komoditiModel = new \App\Models\DataKomoditiModel(); // Asumsikan model untuk tabel data_komoditi
        $komoditi = $komoditiModel->where('nama_komoditi', $nama_sayur)->first();

        if (!$komoditi) {
            session()->setFlashdata('error', 'Data komoditi tidak ditemukan.');
            return redirect()->to('/dataSayur/tambahDataSayur')->withInput();
        }

        $durasi_tanam = $komoditi['durasi_tanam']; // Ambil durasi_tanam dari tabel data_komoditi

        // Hitung waktu prakiraan panen
        $waktu_prakiraan_panen = date('Y-m-d', strtotime($tanggal_tanam . " + $durasi_tanam days"));

        // Simpan data ke database
        $this->dataSayurModel->save([
            'nama_sayur' => $nama_sayur,
            'id_kelompok' => $this->request->getVar('id_kelompok'),
            'tanggal_tanam' => $tanggal_tanam,
            'kategori_tumbuhan' => $this->request->getVar('kategori_tumbuhan'),
            'jumlah_tanam' => $this->request->getVar('jumlah_tanam'),
            'prakiraan_jumlah_panen' => $this->request->getVar('prakiraan_jumlah_panen'),
            'waktu_prakiraan_panen' => $waktu_prakiraan_panen
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/dataSayur');
    }

    public function delete($id_sayur)
    {
        // $sayur = $this->dataSayurModel->find($id_sayur);
        // unlink('../asset/' . $sayur['gambar']);
        $this->dataSayurModel->delete($id_sayur);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/dataSayur');
    }

    public function editDataSayur($id_sayur)
    {
        $sayur = $this->dataSayurModel->getDataSayur($id_sayur);

        // Ambil data `durasi_tanam` dari tabel `data_komoditi` berdasarkan nama sayur
        $komoditi = $this->dataKomoditiModel->where('nama_komoditi', $sayur['nama_sayur'])->first();
        $durasi_tanam = $komoditi['durasi_tanam'] ?? null;
    
        $data = [
            'tittle' => 'Data Sayur | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'sayur' => $sayur,
            'durasi_tanam' => $durasi_tanam,
            'kelompok' => $this->dataKelompokModel->getDataKelompok(),
            'komoditi' => $this->dataKomoditiModel->where('sektor', 'SAYUR')->findAll(),
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
            return redirect()->to('/dataSayur/editDataSayur/' . $id_sayur)->withInput()->with('validation', $validation);
        }

        $data = [
            'nama_sayur' => $this->request->getVar('nama_sayur'),
            'id_kelompok' => $this->request->getVar('id_kelompok'),
            'tanggal_tanam' => $this->request->getVar('tanggal_tanam'),
            'kategori_tumbuhan' => $this->request->getVar('kategori_tumbuhan'),
            'jumlah_tanam' => $this->request->getVar('jumlah_tanam'),
            'prakiraan_jumlah_panen' => $this->request->getVar('prakiraan_jumlah_panen'),
            'waktu_prakiraan_panen' => $this->request->getVar('waktu_prakiraan_panen'),
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
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Masukkan Total Harga Penjualan !!',
                    'numeric' => 'Masukan Harus Berupa Angka !!'
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
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('dataSayur/dataPanenSayur/' . $this->request->getVar('id_sayur'))->withInput()->with('validation', $validation);
        }

        // Ambil file gambar
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

        $this->dataSayurModel->save([
            'id_sayur' => $id_sayur,
            'waktu_panen' => $this->request->getVar('waktu_panen'),
            'jumlah_panen' => $this->request->getVar('jumlah_panen'),
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

        return redirect()->to('/dataSayur');
    }
}
