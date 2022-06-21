<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\BimbinganModel;

class Dashboard extends BaseController {

    public function __construct() {
        $this->user_model       = new UserModel();
        $this->bimbingan_model  = new BimbinganModel();
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->user_model->find(session('id'));
        $data['submission'] = $this->bimbingan_model->count_bimbingan(['id_dosen' => session('id'), 'status' => 0]);
        $data['on_progress'] = $this->bimbingan_model->count_bimbingan(['id_dosen' => session('id'), 'status' => 1]);
        $data['completed'] = $this->bimbingan_model->count_bimbingan(['id_dosen' => session('id'), 'status' => 2]);

        return view('dashboard', $data);
    }
}
