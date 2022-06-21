<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Dashboard extends BaseController {

    public function __construct() {
        $this->user_model = new UserModel();
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->user_model->find(session('id'));

        return view('dashboard', $data);
    }
}
