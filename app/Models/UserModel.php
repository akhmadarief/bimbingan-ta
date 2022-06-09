<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model {
    protected $table            = 'user';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'name', 'nip_nim', 'email', 'email_verified', 'password', 'role'];
}
