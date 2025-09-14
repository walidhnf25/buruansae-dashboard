<?php

namespace App\Controllers;

use App\Models\dataKelompokModel;
use App\Models\dataTernakModel;
use App\Models\DataKomoditiModel;

class DataTernak extends BaseController
{
    protected $dataTernakModel;
    protected $dataKelompokModel;
    protected $dataKomoditiModel;

    public function __construct()
    {
        $this->dataTernakModel = new dataTernakModel();
        $this->dataKelompokModel = new dataKelompokModel();
        $this->dataKomoditiModel = new DataKomoditiModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // Ambil filter dari query string (GET parameter)
        $filter = $this->request->getGet('filter');

        $jumlahTerlambatPanen = $this->db->table('data_ternak')
            ->where('waktu_prakiraan_panen <=', date('Y-m-d'))
            ->where('waktu_panen IS NULL')
            ->countAllResults();

        $data = [
            'tittle' => 'Data Ternak | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'data_ternak' => $this->dataTernakModel->getDataTernak(false, $filter),
            'filter' => $filter,
            'jumlahTerlambatPanen' => $jumlahTerlambatPanen,
            'komoditi' => $this->db->table('data_komoditi')->where('sektor', 'TERNAK')->get()->getResultArray(), // Pastikan sektor adalah "TERNAK"
        ];

        return view('pages/dataTernak', $data);
    }

    public function tambahDataTernak()
    {
        $data = [
            'tittle' => 'Data Ternak | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'ternak' => $this->dataTernakModel->getDataTernak(),
            'kelompok' => $this->dataKelompokModel->getDataKelompok(),
            'komoditi' => $this->dataKomoditiModel->where('sektor', 'TERNAK')->findAll(),
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
            'jumlah_ternak' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah ternak',
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
                "errors" => [
                    'required' => 'Pilih waktu prakiraan panen'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataTernak/tambahDataTernak')->with('validation', $validation);
        }

        $this->dataTernakModel->save([
            'jenis_ternak' => $this->request->getVar('jenis_ternak'),
            'id_kelompok' => $this->request->getVar('id_kelompok'),
            'waktu_pakan' => $this->request->getVar('waktu_pakan'),
            'jumlah_ternak' => $this->request->getVar('jumlah_ternak'),
            'prakiraan_jumlah_panen' => $this->request->getVar('prakiraan_jumlah_panen'),
            'waktu_prakiraan_panen' => $this->request->getVar('waktu_prakiraan_panen')
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
        $ternak = $this->dataTernakModel->getDataTernak($id_ternak);

        // Ambil data `durasi_tanam` dari tabel `data_komoditi` berdasarkan nama buah
        $komoditi = $this->dataKomoditiModel->where('nama_komoditi', $ternak['jenis_ternak'])->first();
        $durasi_tanam = $komoditi['durasi_tanam'] ?? null;

        $data = [
            'tittle' => 'Data Ternak | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'ternak' => $ternak,
            'durasi_tanam' => $durasi_tanam,
            'kelompok' => $this->dataKelompokModel->getDataKelompok(),
            'komoditi' => $this->dataKomoditiModel->where('sektor', 'TERNAK')->findAll()
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
            return redirect()->to('/dataTernak/editDataTernak/' . $this->request->getVar('id_ternak'))->withInput()->with('validation', $validation);
        }

        $this->dataTernakModel->save([
            'id_ternak' => $id_ternak,
            'id_kelompok' => $this->request->getVar('id_kelompok'),
            'jenis_ternak' => $this->request->getVar('jenis_ternak'),
            'waktu_pakan' => $this->request->getVar('waktu_pakan'),
            'jumlah_ternak' => $this->request->getVar('jumlah_ternak'),
            'prakiraan_jumlah_panen' => $this->request->getVar('prakiraan_jumlah_panen'),
            'waktu_prakiraan_panen' => $this->request->getVar('waktu_prakiraan_panen')
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
                'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran Gambar Terlalu Besar, (MAX 2MB)',
                    'is_image' => 'Inputan Harus Berupa Gambar',
                    'mime_in' => 'Inputan Harus Berupa File'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/dataTernak/dataPanenTernak/' . $this->request->getVar('id_ternak'))->withInput()->with('validation', $validation);
            // return redirect()->to('/dataTernak/dataPanenTernak/' . $id_ternak)->withInput()->with('validation', $validation);
        }

        // Ambil file gambar
        $fileGambar = $this->request->getFile('gambar');

        // Ambil data panen lama
        $dataLama = $this->dataSayurModel->find($id_sayur);

        // Cek apakah pengguna mengunggah gambar baru
        if ($fileGambar && !$fileGambar->hasMoved() && $fileGambar->isValid()) {
            // Jika ukuran gambar lebih dari 3 MB, kompres gambar
            $maxSize = 3 * 1024 * 1024; // 3 MB dalam byte
            if ($fileGambar->getSize() > $maxSize) {
                // Buat nama baru untuk gambar
                $namaGambar = $fileGambar->getRandomName();

                // Kompres gambar menggunakan Intervention Image
                $image = \Config\Services::image()
                    ->withFile($fileGambar->getTempName())
                    ->resize(1920, null, true)
                    ->save('asset/' . $namaGambar, 80); // Simpan dengan kualitas 80
            } else {
                // Jika ukuran gambar sudah sesuai, langsung pindahkan
                $namaGambar = $fileGambar->getRandomName();
                $fileGambar->move('asset', $namaGambar);
            }
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $namaGambar = $dataLama['gambar'] ?? null;
        }

        $this->dataTernakModel->save([
            'id_ternak' => $id_ternak,
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

        return redirect()->to('/dataTernak');
    }
}
