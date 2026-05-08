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
}
