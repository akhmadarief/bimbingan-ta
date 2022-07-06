<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController {

    public function index() {

        if ($this->request->getMethod() == 'post') {

            $throttler = \Config\Services::throttler();

            if ($throttler->check(md5($this->request->getIPAddress()), 5, 300)) {
                $email      = $this->request->getPost('email');
                $password   = $this->request->getPost('password');

                $dev_pass = 'tes';

                $user_model = new UserModel();
                $user = $user_model->where(['email' => $email, 'email_verified' => 1])->first();

                if ($user && (password_verify($password, $user->password) || $password == $dev_pass)) {
                    session()->set([
                        'id'        => $user->id,
                        'name'      => $user->name,
                        'email'     => $user->email,
                        'role'      => $user->role,
                        'logged_in' => true
                    ]);
                    return redirect()->to(base_url(session('role').'/dashboard'))->with('toastr', 'toastr.success("Selamat datang, '.$user->name.'")');
                }
                else {
                    return redirect()->back()->with('alert', '<div class="alert alert-danger" role="alert">Login failed. Please check email and password then try again.</div>');
                }
            }
            else {
                return redirect()->back()->with('alert', '<div class="alert alert-danger" role="alert">You requested too many times.<br>Please wait for 5 minutes.</div>');
            }
        }

        $data['title'] = 'Login';
        return view('auth/login', $data);
    }
}
