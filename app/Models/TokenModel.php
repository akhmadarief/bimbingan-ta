<?php

namespace App\Models;
use CodeIgniter\Model;

class TokenModel extends Model {
    protected $table            = 'user_token';
    protected $primaryKey       = 'email';
    protected $returnType       = 'object';
    protected $allowedFields    = ['email', 'type', 'token', 'expired_at'];
}
