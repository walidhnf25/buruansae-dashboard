<?php

namespace App\Controllers;

use App\Models\dataSayurModel;
use App\Models\dataTanamanObatModel;
use App\Models\dataTernakModel;
use App\Models\dataIkanModel;
use App\Models\dataBuahModel;
use App\Models\dataKelompokModel;
use App\Models\dataOlahanHasilModel;
use App\Models\dataPengolahanSampahModel;

class DataPanen extends BaseController
{
    protected $dataSayurModel;
    protected $dataTanamanObatModel;
    protected $dataTernakModel;
    protected $dataIkanModel;
    protected $dataBuahModel;
    protected $dataOlahanHasilModel;
    protected $dataPengolahanSampahModel;
    

    public function __construct()
    {
        $this->dataSayurModel = new dataSayurModel();
        $this->dataTanamanObatModel = new dataTanamanObatModel();
        $this->dataTernakModel = new dataTernakModel();
        $this->dataIkanModel = new dataIkanModel();
        $this->dataBuahModel = new dataBuahModel();
        $this->dataOlahanHasilModel = new dataOlahanhasilModel();
        $this->dataPengolahanSampahModel = new dataPengolahanSampahModel();

    }

    public function index()
    {


        $data = [
            'tittle' => 'Data Panen | Buruan SAE',
            'data_sayur' => $this->dataSayurModel->getDataSayur(),
            'data_tanaman_obat' => $this->dataTanamanObatModel->getDataTanamanObat(),
            'ternak' => $this->dataTernakModel->getDataTernak(),
            'ikan' => $this->dataIkanModel->getDataIkan(),
            'buah' => $this->dataBuahModel->getDataBuah(),
            'olahan_hasil' => $this->dataOlahanHasilModel->getDataOlahanHasil(),
            'sampah' => $this->dataPengolahanSampahModel->getDataSampah(),
            'validation' => \Config\Services::validation()
        ];

        return view('pages/dataPanen', $data);
    }
}
