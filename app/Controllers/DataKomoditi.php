<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataKomoditiModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\I18n\TimeDifference;


class DataKomoditi extends BaseController
{
    protected $datakomoditiModel;
    public function __construct()
    {
        $this->datakomoditiModel = new DataKomoditiModel();
    }

    public function index()
    {
        $data = [
            'tittle' => 'Data Komoditi | Buruan SAE',
            'data_komoditi' => $this->datakomoditiModel->getDataKomoditi()
        ];

        return view('pages/datakomoditi/dataKomoditi', $data);
    }

    public function createDataKomoditi()
    {
        $data = [
            'tittle' => 'Form Tambah Data Komoditi | Buruan SAE',
            'validation' => \Config\Services::validation()
        ];

        return view('pages/DataKomoditi/createDataKomoditi', $data);
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
            'start_date' => [
                'rules' => 'required|',
                'errors' => [
                    'required' => 'Start date harus diisi'
                ]
            ],
            'end_date' => [
                'rules' => 'required|',
                'errors' => [
                    'required' => 'End date harus diisi',
                ]
            ],
        ])) {
            return redirect()->to('/DataKomoditi/createDataKomoditi')->withInput();
        }

        // Get the start and end dates from the request
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Convert the dates to DateTime objects
        $start = Time::parse($startDate);
        $end = Time::parse($endDate);

        // Calculate the duration
        $duration = $start->difference($end)->getDays();

        $this->datakomoditiModel->save([
            'nama_komoditi' => $this->request->getVar('nama_komoditi'),
            'sektor' => $this->request->getVar('sektor'),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'durasi_tanam' => $duration . ' Hari',
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/DataKomoditi');
    }

    public function edit($id)
    {
        $data = [
            'tittle' => 'Form Edit Data Komoditi | Buruan SAE',
            'validation' => \Config\Services::validation(),
            'komoditi' => $this->datakomoditiModel->getDataKomoditi($id)
        ];

        return view('pages/DataKomoditi/editDataKomoditi', $data);
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
            'start_date' => [
                'rules' => 'required|',
                'errors' => [
                    'required' => 'Start date harus diisi'
                ]
            ],
            'end_date' => [
                'rules' => 'required|',
                'errors' => [
                    'required' => 'End date harus diisi',
                ]
            ],
        ])) {
            return redirect()->to('/DataKomoditi/edit/' . $id)->withInput();
        }

        // Get the start and end dates from the request
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Convert the dates to DateTime objects
        $start = Time::parse($startDate);
        $end = Time::parse($endDate);

        // Calculate the duration
        $duration = $start->difference($end)->getDays();

        $this->datakomoditiModel->save([
            'id' => $id,
            'nama_komoditi' => $this->request->getVar('nama_komoditi'),
            'sektor' => $this->request->getVar('sektor'),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'durasi_tanam' => $duration . ' Hari',
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/DataKomoditi');
    }

    public function delete($id)
    {
        $this->datakomoditiModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/DataKomoditi');
    }
}
