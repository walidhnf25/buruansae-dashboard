<?php

namespace App\Controllers;

use App\Models\dataKelompokModel;
use App\Models\dataSayurModel;
use App\Models\dataBuahModel;
use App\Models\dataTernakModel;
use App\Models\dataTanamanObatModel;
use App\Models\dataPengolahanSampahModel;
use App\Models\dataOlahanHasilModel;
use App\Models\dataIkanModel;

class DataKelompok extends BaseController
{
    protected $dataKelompokModel;
    public function __construct()
    {
        $this->dataKelompokModel = new dataKelompokModel();
    }

    public function index()
    {
        $data = [
            'tittle' => 'Data Kelompok | Buruan SAE',
            'data_kelompok' => $this->dataKelompokModel->getDataKelompok(),
            'validation' => \Config\Services::validation()
        ];

        return view('pages/datakelompok/dataKelompokView', $data);
    }

    public function tambahDataKelompok()
    {
        $data = [
            'tittle' => 'Data Kelompok | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'data_kelompok' =>$this->dataKelompokModel->getDataKelompok()
        ];
        return view('pages/datakelompok/tambahDataKelompok', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'nama_kelompok' => 'required',
            'nama_ketua' => 'required',
            'nomor_kontak' => 'required',
            'penyuluh' => 'required',
            'pendamping' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'rw' => 'required',
            'luas_lahan' => 'required|numeric',
            'status_lahan' => 'required',
            'latitude' => 'required',
            'lontitude' => 'required',
            'link_deskripsi' => 'required',
            'foto_lahan' => [
                'rules' => 'if_exist|max_size[foto_lahan,2048]|is_image[foto_lahan]|mime_in[foto_lahan,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran foto lahan terlalu besar (max 2MB)',
                    'is_image' => 'Foto lahan harus berupa gambar',
                    'mime_in'  => 'Format foto lahan harus jpg/jpeg/png'
                ]
            ],
            'foto_ketua' => [
                'rules' => 'if_exist|max_size[foto_ketua,2048]|is_image[foto_ketua]|mime_in[foto_ketua,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran foto ketua terlalu besar (max 2MB)',
                    'is_image' => 'Foto ketua harus berupa gambar',
                    'mime_in'  => 'Format foto ketua harus jpg/jpeg/png'
                ]
            ]
        ])) {
            return redirect()->to('/DataKelompok')->withInput();
        }

        // ==== Upload Foto Lahan ====
        $fotoLahan = $this->request->getFile('foto_lahan');
        if ($fotoLahan && $fotoLahan->isValid() && !$fotoLahan->hasMoved()) {
            $namaFotoLahan = $fotoLahan->getRandomName();
            $fotoLahan->move('asset', $namaFotoLahan);
        } else {
            $namaFotoLahan = null;
        }

        // ==== Upload Foto Ketua ====
        $fotoKetua = $this->request->getFile('foto_ketua');
        if ($fotoKetua && $fotoKetua->isValid() && !$fotoKetua->hasMoved()) {
            $namaFotoKetua = $fotoKetua->getRandomName();
            $fotoKetua->move('asset', $namaFotoKetua);
        } else {
            $namaFotoKetua = null;
        }

        // ==== Simpan ke Database ====
        $this->dataKelompokModel->save([
            'nama_kelompok' => $this->request->getVar('nama_kelompok'),
            'nama_ketua' => $this->request->getVar('nama_ketua'),
            'nomor_kontak' => $this->request->getVar('nomor_kontak'),
            'penyuluh' => $this->request->getVar('penyuluh'),
            'pendamping' => $this->request->getVar('pendamping'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'rw' => $this->request->getVar('rw'),
            'luas_lahan' => $this->request->getVar('luas_lahan'),
            'status_lahan' => $this->request->getVar('status_lahan'),
            'status_keaktifan' => $this->request->getVar('status_keaktifan'),
            'keterangan_status' => $this->request->getVar('keterangan_status'),
            'longtitude' => $this->request->getVar('longtitude'),
            'latitude' => $this->request->getVar('latitude'),
            'link_deskripsi' => $this->request->getVar('link_deskripsi'),
            'foto_lahan' => $namaFotoLahan,
            'foto_ketua' => $namaFotoKetua
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/DataKelompok');
    }

    public function delete($id_kelompok)
    {
        $dataSayurModel = new dataSayurModel();
        $dataBuahModel = new dataBuahModel();
        $dataTernakModel = new dataTernakModel();
        $dataTanamanObatModel = new dataTanamanObatModel();
        $dataSampahModel = new dataPengolahanSampahModel();
        $dataOlahanHasilModel = new dataOlahanHasilModel();
        $dataIkanModel = new dataIkanModel();

        // Hapus baris di tabel terkait
        $dataSayurModel->where('id_kelompok', $id_kelompok)->delete();
        $dataBuahModel->where('id_kelompok', $id_kelompok)->delete();
        $dataTernakModel->where('id_kelompok', $id_kelompok)->delete();
        $dataTanamanObatModel->where('id_kelompok', $id_kelompok)->delete();
        $dataSampahModel->where('id_kelompok', $id_kelompok)->delete();
        $dataOlahanHasilModel->where('id_kelompok', $id_kelompok)->delete();
        $dataIkanModel->where('id_kelompok', $id_kelompok)->delete();

        // Hapus baris di tabel utama
        $this->dataKelompokModel->delete($id_kelompok);
        session()->setFlashdata('pesan', 'Data Kelompok berhasil dihapus.');

        return redirect()->to('/DataKelompok');
    }

    public function editDataKelompok($id_kelompok)
    {
        $data = [
            'tittle' => 'Data Kelompok | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'kelompok' => $this->dataKelompokModel->getDataKelompok($id_kelompok)
        ];
        return view('pages/datakelompok/editDataKelompok', $data);
    }

    public function update($id_kelompok)
    {
        if (!$this->validate([
            'nama_kelompok' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan Nama Kelompok']
            ],
            'nama_ketua' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan Nama Ketua']
            ],
            'nomor_kontak' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan Nomor Kontak']
            ],
            'penyuluh' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan Nama Penyuluh']
            ],
            'pendamping' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan Nama Pendamping']
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan Nama Kecamatan']
            ],
            'kelurahan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan Nama Kelurahan']
            ],
            'rw' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan RW']
            ],
            'luas_lahan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan Luas Lahan']
            ],
            'status_lahan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan Status Lahan']
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan Latitude']
            ],
            'longtitude' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan Longtitude']
            ],
            'link_deskripsi' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan Link Deskripsi']
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/DataKelompok/editDataKelompok/' . $id_kelompok)->withInput()->with('validation', $validation);
        }

        // Ambil data lama
        $dataLama = $this->dataKelompokModel->find($id_kelompok);

        // === Upload Foto Lahan ===
        $fileLahan = $this->request->getFile('foto_lahan');
        if ($fileLahan && $fileLahan->isValid() && !$fileLahan->hasMoved()) {
            $namaFotoLahan = $fileLahan->getRandomName();
            $fileLahan->move('asset', $namaFotoLahan);
        } else {
            $namaFotoLahan = $dataLama['foto_lahan'] ?? null;
        }

        // === Upload Foto Ketua ===
        $fileKetua = $this->request->getFile('foto_ketua');
        if ($fileKetua && $fileKetua->isValid() && !$fileKetua->hasMoved()) {
            $namaFotoKetua = $fileKetua->getRandomName();
            $fileKetua->move('asset', $namaFotoKetua);
        } else {
            $namaFotoKetua = $dataLama['foto_ketua'] ?? null;
        }

        // Simpan ke database
        $this->dataKelompokModel->save([
            'id_kelompok'       => $id_kelompok,
            'nama_kelompok'     => $this->request->getVar('nama_kelompok'),
            'nama_ketua'        => $this->request->getVar('nama_ketua'),
            'nomor_kontak'      => $this->request->getVar('nomor_kontak'),
            'penyuluh'          => $this->request->getVar('penyuluh'),
            'pendamping'        => $this->request->getVar('pendamping'),
            'kecamatan'         => $this->request->getVar('kecamatan'),
            'kelurahan'         => $this->request->getVar('kelurahan'),
            'rw'                => $this->request->getVar('rw'),
            'luas_lahan'        => $this->request->getVar('luas_lahan'),
            'status_lahan'      => $this->request->getVar('status_lahan'),
            'status_keaktifan'  => $this->request->getVar('status_keaktifan'),
            'keterangan_status' => $this->request->getVar('keterangan_status'),
            'latitude' => $this->request->getVar('latitude'),
            'longtitude' => $this->request->getVar('longtitude'),
            'link_deskripsi'    => $this->request->getVar('link_deskripsi'),
            'foto_lahan'        => $namaFotoLahan,
            'foto_ketua'        => $namaFotoKetua,
        ]);

        session()->setFlashdata('pesan', 'Data Kelompok berhasil diubah.');
        return redirect()->to('/DataKelompok');
    }
}
