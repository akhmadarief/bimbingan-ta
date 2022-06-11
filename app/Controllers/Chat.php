<?php

namespace App\Controllers;

class Chat extends BaseController {

    public function index() {
        $data['title'] = 'Chat';
        return view('chat', $data);
    }
}
