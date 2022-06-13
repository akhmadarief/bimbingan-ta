<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class DosenFilter implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null) {
        if (!session()->get('logged_in')){
            return redirect()->to(base_url('login'));
        }
        else if (session()->get('role') != 'dosen') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // Do something here
    }
}
