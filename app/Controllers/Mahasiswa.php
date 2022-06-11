<?php

namespace App\Controllers;
use App\Models\UserModel;

class Mahasiswa extends BaseController {

    public function __construct() {
        $this->user_model = new UserModel();
    }

    public function index() {
        $data['title'] = 'Mahasiswa';
        $data['mhs'] = $this->user_model->where(['role' => 'mhs'])->findAll();

        return view('mahasiswa', $data);
    }
}
