<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('userId');
        $model = new UserModel();
        $user = $model->find($userId);

        if ($this->request->getMethod() === 'POST' || $this->request->getMethod() === 'post') {
            $namaDepan = $this->request->getPost('nama_depan');
            $namaBelakang = $this->request->getPost('nama_belakang');
            $tanggalLahir = $this->request->getPost('tanggal_lahir');
            $jenisKelamin = $this->request->getPost('jenis_kelamin');
            $negara = $this->request->getPost('negara');
            $kota = $this->request->getPost('kota');
            $phonePrefix = $this->request->getPost('phone_prefix');
            $phoneNumber = $this->request->getPost('phone_number');
            
            $fullName = trim($namaDepan . ' ' . $namaBelakang);
            if(empty($fullName)) {
                $fullName = $user['full_name']; // fallback
            }

            $noHandphone = $phonePrefix . $phoneNumber;

            $data = [
                'full_name' => $fullName,
                'no_handphone' => $noHandphone,
                'tanggal_lahir' => $tanggalLahir,
                'gender' => $jenisKelamin,
                'negara' => $negara,
                'kota' => $kota
            ];

            $model->update($userId, $data);
            
            session()->set('userName', $fullName); // update session name
            session()->setFlashdata('success', 'Berhasil mengubah data');
            
            return redirect()->to('/profile');
        }

        // Parse full name for view
        $names = explode(' ', $user['full_name'], 2);
        $namaDepanDb = $names[0] ?? '';
        $namaBelakangDb = $names[1] ?? '';

        $data = [
            'user' => $user,
            'namaDepan' => $namaDepanDb,
            'namaBelakang' => $namaBelakangDb
        ];

        return view('user/profile', $data);
    }

    public function updatePassword()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('userId');
        $model = new UserModel();
        $user = $model->find($userId);

        $oldPassword = $this->request->getPost('old_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        // Check if password matches (support both plain text and hash just in case)
        $isPasswordCorrect = false;
        if (password_verify($oldPassword, $user['password']) || $oldPassword === $user['password']) {
            $isPasswordCorrect = true;
        }

        if (!$isPasswordCorrect) {
            session()->setFlashdata('password_error', 'Kata sandi lama tidak sesuai.');
            session()->setFlashdata('active_tab', 'atur-kata-sandi-section');
            return redirect()->to('/profile');
        }

        if ($newPassword !== $confirmPassword) {
            session()->setFlashdata('password_error', 'Kata sandi baru tidak cocok.');
            session()->setFlashdata('active_tab', 'atur-kata-sandi-section');
            return redirect()->to('/profile');
        }

        if (strlen($newPassword) < 6) {
            session()->setFlashdata('password_error', 'Kata sandi baru minimal 6 karakter.');
            session()->setFlashdata('active_tab', 'atur-kata-sandi-section');
            return redirect()->to('/profile');
        }

        $model->update($userId, [
            'password' => $newPassword
        ]);

        session()->setFlashdata('password_success', 'Berhasil memperbarui kata sandi');
        session()->setFlashdata('active_tab', 'atur-kata-sandi-section');
        return redirect()->to('/profile');
    }
}
