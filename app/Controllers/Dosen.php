<?php

namespace App\Controllers;
use App\Models\UserModel;

class Dosen extends BaseController {

    public function __construct() {
        $this->user_model = new UserModel();
    }

    public function index() {
        $data['title'] = 'Dosen';
        $data['dosen'] = $this->user_model->where(['role' => 'dosen'])->findAll();

        return view('dosen', $data);
    }
}
