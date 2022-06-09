<?php

namespace App\Models;
use CodeIgniter\Model;

class TokenModel extends Model {
    protected $table            = 'user_token';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'user_email', 'type', 'token', 'expired_at'];
}
