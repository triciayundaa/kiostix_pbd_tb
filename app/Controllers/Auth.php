<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->request->getMethod() === 'POST' || $this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $model = new UserModel();
            $user = $model->where('email', $email)->first();

            if ($user && $user['password'] === $password) {
                session()->set('isLoggedIn', true);
                session()->set('userId', $user['id']);
                session()->set('userName', $user['full_name']);
                return redirect()->to('/');
            } else {
                session()->setFlashdata('error', 'Email atau Kata Sandi salah!');
                return redirect()->back();
            }
        }

        return view('auth/login');
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'POST' || $this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $namaDepan = $this->request->getPost('nama_depan');
            $namaBelakang = $this->request->getPost('nama_belakang');
            $phone = $this->request->getPost('phone');
            $password = $this->request->getPost('password');
            $confirmPassword = $this->request->getPost('confirm_password');

            if ($password !== $confirmPassword) {
                session()->setFlashdata('error', 'Konfirmasi Kata Sandi tidak cocok!');
                return redirect()->back()->withInput();
            }

            $model = new UserModel();
            
            // Cek apakah email sudah ada
            if ($model->where('email', $email)->first()) {
                session()->setFlashdata('error', 'Email sudah terdaftar!');
                return redirect()->back()->withInput();
            }

            // Generate UUID
            $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));

            $data = [
                'id' => $uuid,
                'full_name' => trim($namaDepan . ' ' . $namaBelakang),
                'email' => $email,
                'password' => $password, 
                'no_handphone' => '+62' . $phone
            ];

            $model->insert($data);
            
            session()->setFlashdata('success', 'Pendaftaran berhasil! Silakan masuk.');
            return redirect()->to('/login');
        }

        return view('auth/register');
    }
}
