<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'Login | Buruan SAE'
        ];
        echo view('layout/header', $data);
        echo view('pages/login');
    }
}
