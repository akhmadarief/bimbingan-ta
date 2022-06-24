<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class Logout extends BaseController {

    public function index() {
        session()->destroy();

        $data['title'] = 'Logout';
        return view('auth/logout', $data);
    }
}
