<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users'; // Harus sama dengan nama tabel di phpMyAdmin
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'email'];
}