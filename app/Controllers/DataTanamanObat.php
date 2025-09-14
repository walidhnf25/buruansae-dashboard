<?php

namespace App\Controllers;

use App\Models\dataTanamanObatModel;
use App\Models\dataKelompokModel;
use App\Models\DataKomoditiModel;

class DataTanamanObat extends BaseController
{
    protected $dataTanamanObatModel;
    protected $dataKelompokModel;
    protected $dataKomoditiModel;
    public function __construct()
    {
        $this->dataTanamanObatModel = new dataTanamanObatModel();
        $this->dataKelompokModel = new dataKelompokModel();
        $this->dataKomoditiModel = new DataKomoditiModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // Ambil filter dari query string (GET parameter)
        $filter = $this->request->getGet('filter');

        $jumlahTerlambatPanen = $this->db->table('data_tanaman_obat')
            ->where('waktu_prakiraan_panen <=', date('Y-m-d'))
            ->where('waktu_panen IS NULL')
            ->countAllResults();

        $data = [
            'tittle' => 'Data Tanaman Obat | Buruan SAE',
            'komoditi' => $this->db->table('data_komoditi')->get()->getResultArray(),
            'validation' => \Config\Services::validation(),
            'filter' => $filter,
            'jumlahTerlambatPanen' => $jumlahTerlambatPanen,
            'data_tanaman_obat' => $this->dataTanamanObatModel->getDataTanamanObat(false, $filter),
        ];

        return view('pages/dataTanamanObat', $data);
    }

    public function tambahDataTanamanObat()
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
            return redirect()->to('/dataTanamanObat/tambahDataTanamanObat')->withInput()->with('validation', $validation);
        }

        $this->dataTanamanObatModel->save([
            'nama_tanaman_obat' => $this->request->getVar('nama_tanaman_obat'),
            'id_kelompok' => $this->request->getVar('id_kelompok'),
            'tanggal_tanam' => $this->request->getVar('tanggal_tanam'),
            'kategori_tumbuhan' => $this->request->getVar('kategori_tumbuhan'),
            'jumlah_tanam' => $this->request->getVar('jumlah_tanam'),
            'prakiraan_jumlah_panen' => $this->request->getVar('prakiraan_jumlah_panen'),
            'waktu_prakiraan_panen' => $this->request->getVar('waktu_prakiraan_panen')
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
        // Ambil data tanaman obat berdasarkan ID
        $obat = $this->dataTanamanObatModel->getDataTanamanObat($id_tanaman_obat);

        // Ambil data `durasi_tanam` dari tabel `data_komoditi` berdasarkan nama tanaman obat
        $komoditi = $this->dataKomoditiModel->where('nama_komoditi', $obat['nama_tanaman_obat'])->first();
        $durasi_tanam = $komoditi['durasi_tanam'] ?? null;

        $data = [
            'tittle' => 'Edit Data Tanaman Obat | Buruan SAE',
            'obat' => $obat,
            'durasi_tanam' => $durasi_tanam, // Kirim durasi tanam ke view
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
            return redirect()->to('/dataTanamanObat/editDataTanamanObat/' . $this->request->getVar('id_tanaman_obat'))->withInput()->with('validation', $validation);
        }

        $data = [
            'nama_tanaman_obat' => $this->request->getVar('nama_tanaman_obat'),
            'id_kelompok' => $this->request->getVar('id_kelompok'),
            'tanggal_tanam' => $this->request->getVar('tanggal_tanam'),
            'kategori_tumbuhan' => $this->request->getVar('kategori_tumbuhan'),
            'jumlah_tanam' => $this->request->getVar('jumlah_tanam'),
            'prakiraan_jumlah_panen' => $this->request->getVar('prakiraan_jumlah_panen'),
            'waktu_prakiraan_panen' => $this->request->getVar('waktu_prakiraan_panen')
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
                'rules' => 'required|numeric[id_tanaman_obat.jumlah_panen]',
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
                'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran Gambar Terlalu Besar, (MAX 2MB)',
                    'is_image' => 'Inputan Harus Berupa Gambar',
                    'mime_in' => 'Inputan Harus Berupa File'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('dataTanamanObat/dataPanenTanamanObat/' . $this->request->getVar('id_tanaman_obat'))->withInput()->with('validation', $validation);
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

        $this->dataTanamanObatModel->save([
            'id_tanaman_obat' => $id_tanaman_obat,
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
            'gambar' => $namaGambar,
        ]);

        session()->setFlashdata('pesan', 'Data panen berhasil disimpan.');

        return redirect()->to('/dataTanamanObat');
    }
}
