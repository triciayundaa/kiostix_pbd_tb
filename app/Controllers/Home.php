<?php

namespace App\Controllers;

use App\Models\UserModel; // JANGAN SAMPAI TYPO DI SINI

class Home extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['semua_user'] = $model->findAll();

        return view('tampilan_user', $data);
    }
}