<?php

namespace App\Controllers;

use App\Models\UserModel; // JANGAN SAMPAI TYPO DI SINI

class Home extends BaseController
{
    public function index()
    {
        return view('kiostix_home');
    }
}