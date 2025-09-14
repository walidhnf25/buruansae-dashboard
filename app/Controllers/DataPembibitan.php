<?php

namespace App\Controllers;

use App\Models\dataKelompokModel;
use App\Models\dataPembibitanModel;
use App\Models\DataKomoditiModel;

class DataPembibitan extends BaseController
{
    protected $dataPembibitanModel;
    protected $dataKelompokModel;
    protected $dataKomoditiModel;
    public function __construct()
    {
        $this->dataPembibitanModel = new dataPembibitanModel();
        $this->dataKelompokModel = new dataKelompokModel();
        $this->dataKomoditiModel = new DataKomoditiModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // Ambil filter dari query string (GET parameter)
        $filter = $this->request->getGet('filter');

        // Hitung jumlah komoditi yang sudah melewati waktu panen (waktu_prakiraan_panen <= hari ini DAN waktu_panen masih NULL)
        $jumlahTerlambatPanen = $this->db->table('data_bibit')
            ->where('waktu_prakiraan_panen <=', date('Y-m-d'))
            ->where('waktu_panen IS NULL')
            ->countAllResults();

        $data = [
            'tittle' => 'Data Bibit | Buruan SAE',
            'data_bibit' => $this->dataPembibitanModel->getDataBibit(false, $filter),
            'komoditi' => $this->db->table('data_komoditi')->get()->getResultArray(),
            'filter' => $filter,
            'jumlahTerlambatPanen' => $jumlahTerlambatPanen,
            'validation' => \Config\Services::validation()
        ];

        return view('pages/dataPembibitan', $data);
    }

    public function tambahDataPembibitan()
    {
        $data = [
            'tittle' => 'Data Bibit | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'kelompok' => $this->dataKelompokModel->getDataKelompok(),
            'bibit' => $this->dataPembibitanModel->getDataBibit(),
            'komoditi' => $this->dataKomoditiModel->where('sektor', 'BIBIT')->findAll()
        ];
        return view('pages/tambahDataPembibitan', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'tanggal_tanam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
            'nama_sayur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan nama sayur'
                ]
            ],
            'asal_bibit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan asal bibit'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan keterangan asal bibit'
                ]
            ],
            'jumlah_semai' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah semai',
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
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/DataPembibitan/tambahDataPembibitan')->withInput()->with('validation', $validation);
        }

        // Ambil data durasi tanam dari tabel data_komoditi
        $nama_sayur = $this->request->getVar('nama_sayur');
        $tanggal_tanam = $this->request->getVar('tanggal_tanam');
        $komoditiModel = new \App\Models\DataKomoditiModel(); // Asumsikan model untuk tabel data_komoditi
        $komoditi = $komoditiModel->where('nama_komoditi', $nama_sayur)->first();

        if (!$komoditi) {
            session()->setFlashdata('error', 'Data komoditi tidak ditemukan.');
            return redirect()->to('/dataBibit/tambahDataPembibitan')->withInput();
        }

        $durasi_tanam = $komoditi['durasi_tanam']; // Ambil durasi_tanam dari tabel data_komoditi

        // Hitung waktu prakiraan panen
        $waktu_prakiraan_panen = date('Y-m-d', strtotime($tanggal_tanam . " + $durasi_tanam days"));

        $this->dataPembibitanModel->save([
            'nama_sayur' => $nama_sayur,
            'id_kelompok' => $this->request->getVar('id_kelompok'),
            'tanggal_tanam' => $tanggal_tanam,
            'asal_bibit' => $this->request->getVar('asal_bibit'),
            'keterangan' => $this->request->getVar('keterangan'),
            'jumlah_semai' => $this->request->getVar('jumlah_semai'),
            'prakiraan_jumlah_panen' => $this->request->getVar('prakiraan_jumlah_panen'),
            'waktu_prakiraan_panen' => $waktu_prakiraan_panen
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/DataPembibitan');
    }

    public function delete($id_bibit)
    {
        $this->dataPembibitanModel->delete($id_bibit);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/dataPembibitan');
    }

    public function editDataPembibitan($id_bibit)
    {
        $bibit = $this->dataPembibitanModel->getDataBibit($id_bibit);

        // Ambil data `durasi_tanam` dari tabel `data_komoditi` berdasarkan nama sayur
        $komoditi = $this->dataKomoditiModel->where('nama_komoditi', $bibit['nama_sayur'])->first();
        $durasi_tanam = $komoditi['durasi_tanam'] ?? null;

        $data = [
            'tittle' => 'Data Bibit | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'bibit' => $bibit,
            'durasi_tanam' => $durasi_tanam,
            'kelompok' => $this->dataKelompokModel->getDataKelompok(),
            'komoditi' => $this->dataKomoditiModel->where('sektor', 'BIBIT')->findAll(),
        ];

        return view('pages/editDataPembibitan', $data);
    }

    public function update($id_bibit)
    {
        // validasi input
        if (!$this->validate([
            'tanggal_tanam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal'
                ]
            ],
            'nama_sayur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan nama sayur'
                ]
            ],
            'asal_bibit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan asal bibit'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan keterangan asal bibit'
                ]
            ],
            'jumlah_semai' => [
                'rules' => 'required', 'numeric',
                'errors' => [
                    'required' => 'Masukkan jumlah semai',
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
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/DataPembibitan/editDataBibit' . $this->request->getVar('id_bibit'))->withInput()->with('validation', $validation);
        }

        $this->dataPembibitanModel->save([
            'nama_sayur' => $this->request->getVar('nama_sayur'),
            'id_kelompok' => $this->request->getVar('id_kelompok'),
            'tanggal_tanam' => $this->request->getVar('tanggal_tanam'),
            'asal_bibit' => $this->request->getVar('asal_bibit'),
            'keterangan' => $this->request->getVar('keterangan'),
            'jumlah_semai' => $this->request->getVar('jumlah_semai'),
            'prakiraan_jumlah_panen' => $this->request->getVar('prakiraan_jumlah_panen'),
            'waktu_prakiraan_panen' => $this->request->getVar('waktu_prakiraan_panen'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/DataPembibitan');
    }

    public function dataPanenPembibitan($id_bibit)
    {
        session();
        $data = [
            'tittle' => 'Data Bibit | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'id_bibit' => $this->dataPembibitanModel->getDataBibit($id_bibit)
        ];
        return view('pages/dataPanenPembibitan', $data);
    }

    public function updateDataPanen($id_bibit)
    {

        if (!$this->validate([
            'waktu_panen' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Panen Harus Diisi !!'
                ]
            ],
            'jumlah_panen' => [
                'rules' => 'required|numeric[id_bibit.jumlah_panen]',
                'errors' => [
                    'required' => 'Masukkan Jumlah Panen !!',
                    'numeric' => 'Masukan Berupa Angka !!'
                ]
            ],
            'jumlah_kp' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Jumlah Pohon Konsumsi Pribadi !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_ms' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Jumlah Pohon Dibagikan Masyarakat Sekitar !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_sekolah' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Jumlah Pohon Dibagikan Sekolah !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_pkk' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Jumlah Pohon Dibagikan PKK !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_posyandu' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Jumlah Pohon Dibagikan Posyandu !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_lainnya' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Jumlah Pohon Dibagikan Lainnya !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_kk' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Jumlah Orang Dibagikan !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_orang' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Jumlah KK Dibagikan !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_dijual_pohon' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Jumlah Pohon Dijual !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_dijual_orang' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Jumlah Orang !!',
                    'decimal' => 'Masukan harus berupa angka !!'
                ]
            ],
            'jumlah_dijual_kk' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Masukkan Jumlah KK !!',
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
            return redirect()->to('dataSayur/dataPanenSayur/' . $this->request->getVar('id_bibit'))->withInput()->with('validation', $validation);
        }

        // Ambil file gambar
        $fileGambar = $this->request->getFile('gambar');

        // Ambil data panen lama
        $dataLama = $this->dataPembibitanModel->find($id_bibit);

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

        $this->dataPembibitanModel->save([
            'id_bibit' => $id_bibit,
            'waktu_panen' => $this->request->getVar('waktu_panen'),
            'jumlah_panen' => $this->request->getVar('jumlah_panen'),
            'jumlah_kp' => $this->request->getVar('jumlah_kp'),
            'jumlah_ms' => $this->request->getVar('jumlah_ms'),
            'jumlah_sekolah' => $this->request->getVar('jumlah_sekolah'),
            'jumlah_pkk' => $this->request->getVar('jumlah_pkk'),
            'jumlah_posyandu' => $this->request->getVar('jumlah_posyandu'),
            'jumlah_lainnya' => $this->request->getVar('jumlah_lainnya'),
            'jumlah_kk' => $this->request->getVar('jumlah_kk'),
            'jumlah_orang' => $this->request->getVar('jumlah_orang'),
            'jumlah_dijual_pohon' => $this->request->getVar('jumlah_dijual_pohon'),
            'jumlah_dijual_orang' => $this->request->getVar('jumlah_dijual_orang'),
            'jumlah_dijual_kk' => $this->request->getVar('jumlah_dijual_kk'),
            'harga_jual' => $this->request->getVar('harga_jual'),
            'gambar' => $namaGambar
        ]);

        session()->setFlashdata('pesan', 'Data panen berhasil disimpan.');

        return redirect()->to('/dataPembibitan');
    }
}