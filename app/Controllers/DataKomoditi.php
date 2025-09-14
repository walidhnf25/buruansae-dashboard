<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataKomoditiModel;



class DataKomoditi extends BaseController
{
    protected $dataKomoditiModel;
    public function __construct()
    {
        $this->dataKomoditiModel = new dataKomoditiModel();
    }

    public function index()
    {
        $data = [
            'tittle' => 'Data Komoditi | Buruan SAE',
            'data_komoditi' => $this->dataKomoditiModel->getDataKomoditi()
        ];

        return view('pages/komoditi/dataKomoditi', $data);
    }

    public function createDataKomoditi()
    {
        $data = [
            'tittle' => 'Form Tambah Data Komoditi | Buruan SAE',
            'validation' => \Config\Services::validation()
        ];

        return view('pages/komoditi/createDataKomoditi', $data);
    }

    public function save()
    {
        // validasi input

        if (!$this->validate([
            'nama_komoditi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama komoditi harus diisi'
                ]
            ],
            'sektor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sektor harus diisi'
                ]
            ],
            'durasi_tanam' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Durasi tanam harus diisi',
                    'numeric' => 'Durasi tanam harus berupa angka'
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
            return redirect()->to('/DataKomoditi/createDataKomoditi')->withInput();
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

        $this->dataKomoditiModel->save([
            'nama_komoditi' => $this->request->getVar('nama_komoditi'),
            'sektor' => $this->request->getVar('sektor'),
            'durasi_tanam' => $this->request->getVar('durasi_tanam') . 'Hari',
            'gambar' => $namaGambar
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('dataKomoditi');
    }

    public function edit($id)
    {
        $data = [
            'tittle' => 'Form Edit Data Komoditi | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'komoditi' => $this->dataKomoditiModel->getDataKomoditi($id)
        ];

        return view('pages/komoditi/editDataKomoditi', $data);
    }

    public function update($id)
    {
        // validasi input

        if (!$this->validate([
            'nama_komoditi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama komoditi harus diisi'
                ]
            ],
            'sektor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sektor harus diisi'
                ]
            ],
            'durasi_tanam' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Durasi tanam harus diisi',
                    'numeric' => 'Durasi tanam harus berupa angka'
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
            return redirect()->to('/DataKomoditi/edit/' . $id)->withInput();
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

        $this->dataKomoditiModel->save([
            'id' => $id,
            'nama_komoditi' => $this->request->getVar('nama_komoditi'),
            'sektor' => $this->request->getVar('sektor'),
            'durasi_tanam' => $this->request->getVar('durasi_tanam') . 'Hari',
            'gambar' => $namaGambar
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('dataKomoditi');
    }

    public function delete($id)
    {
        $this->dataKomoditiModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('dataKomoditi');
    }
}
