<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'Buruan SAE | Home'
        ];

        return view('pages/home', $data);
    }
}
