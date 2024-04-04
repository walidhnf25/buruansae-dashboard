<?php

namespace App\Controllers;

use App\Models\dataKelompokModel;

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
        if (!$this->validate([
            'penyuluh' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama Penyuluh'
                ]
            ],
            'pendamping' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama Pendamping'
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama Kecamatan'
                ]
            ],
            'kelurahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama Kelurahan'
                ]
            ],
            'rw' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama RW'
                ]
            ],
            'nama_kelompok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama Kelompok'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/DataKelompok/tambahDataKelompok')->withInput()->with('validation', $validation);
        }
        $this->dataKelompokModel->save([
            'penyuluh' => $this->request->getVar('penyuluh'),
            'pendamping' => $this->request->getVar('pendamping'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'rw' => $this->request->getVar('rw'),
            'nama_kelompok' => $this->request->getVar('nama_kelompok'),
        ]);

        session()->setFlashdata('pesan', 'Data Kelompok berhasil ditambahkan.');

        return redirect()->to('/DataKelompok');
    }

    public function delete($id_kelompok)
    {
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

    public function update($id_kelompok){
        if (!$this->validate([
            'penyuluh' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama Penyuluh'
                ]
            ],
            'pendamping' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama Pendamping'
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama Kecamatan'
                ]
            ],
            'kelurahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama Kelurahan'
                ]
            ],
            'rw' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama RW'
                ]
            ],
            'nama_kelompok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama Kelompok'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/DataKelompok/editDataKelompok')->withInput()->with('validation', $validation);
        }
        $this->dataKelompokModel->save([
            'id_kelompok' => $id_kelompok,
            'penyuluh' => $this->request->getVar('penyuluh'),
            'pendamping' => $this->request->getVar('pendamping'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'rw' => $this->request->getVar('rw'),
            'nama_kelompok' => $this->request->getVar('nama_kelompok'),
        ]);

        session()->setFlashdata('pesan', 'Data Kelompok berhasil diubah.');

        return redirect()->to('/DataKelompok');
    }
}