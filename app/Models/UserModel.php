<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model {
    protected $table            = 'user';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'name', 'nip_nim', 'email', 'email_verified', 'password', 'role'];
    protected $beforeInsert     = ['passwordHash'];
    protected $beforeUpdate     = ['passwordHash'];

    protected function passwordHash(array $data) {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        }

        return $data;
    }
}
