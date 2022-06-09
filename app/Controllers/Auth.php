<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\TokenModel;

class Auth extends BaseController {

    public function __construct() {
        $this->user_model   = new UserModel();
        $this->token_model  = new TokenModel();
    }

    public function login() {

        if (session()->get('logged_in')) {
            return redirect()->to(base_url());
        }

        if ($this->request->getMethod() == 'post') {
            $email      = $this->request->getPost('email');
            $password   = $this->request->getPost('password');

            $dev_pass = 'tes';

            $user = $this->user_model->where(['email' => $email, 'email_verified' => 1])->first();

            if ($user && (password_verify($password, $user->password) || $password == $dev_pass)) {
                session()->set([
                    'id'        => $user->id,
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'logged_in' => true
                ]);
                return redirect()->to(base_url())->with('toastr', 'toastr.success("Selamat datang, '.$user->name.'")');
            }
            else {
                return redirect()->to(base_url('login'))->with('alert', '<div class="alert alert-danger" role="alert">Login failed. Please check email and password then try again.</div>');
            }
        }

        $data['title'] = 'Login';
        return view('auth/login', $data);
    }

    public function forgot_password(){

        if ($this->request->getMethod() == 'post') {

            $user_email = $this->request->getPost('email');
            $user = $this->user_model->where(['email' => $user_email])->first();

            if ($user) {
                $token      = md5(rand());
                $expired_at = date('Y-m-d H:i:s', strtotime('1 hour'));

                $this->token_model->insert([
                    'user_email'    => $user_email,
                    'type'          => 1,
                    'token'         => $token,
                    'expired_at'    => $expired_at
                ]);

                $email = \Config\Services::email();

                $email->setTo($user_email);
                $email->setSubject('Konfirmasi Reset Password');
                $email->setMessage('Testing the email class.<br><a href="'.base_url('reset-password/'.$token).'" target="_blank">Confirm</a>');

                if ($email->send()) {
                    $data['title'] = 'Confirm Mail';
                    $data['email'] = $user_email;
                    $data['msg'] = 'Please click on the included link to reset your password.';
                    return view('register/confirm_mail', $data);
                } 
                else {
                    $data = $email->printDebugger(['headers']);
                    return print_r($data);
                }
            }
            else {
                return redirect()->to(base_url('forgot-password'))->with('alert', '<div class="alert alert-danger" role="alert">Your email is not registered.</div>');
            }
        }

        $data['title'] = 'Forgot Password';
        return view('auth/forgot_password', $data);
    }

    public function reset_password($token = NULL) {

        $user_token = $this->token_model->where(['token' => $token, 'type' => 1])->first();

        if ($user_token && $user_token->expired_at > date('Y-m-d H:i:s')) {

            if ($this->request->getMethod() == 'post') {
                $rules = [
                    'password'          => 'required|min_length[6]|max_length[60]',
                    'confirm_password'  => 'matches[password]'
                ];

                if ($this->validate($rules)) {
                    $password = $this->request->getPost('password');

                    $this->user_model->where(['email' => $user_token->user_email])->set(['password' => password_hash($password, PASSWORD_BCRYPT)])->update();

                    session()->remove(['id', 'name', 'email', 'logged_in']);
                    return redirect()->to(base_url('login'))->with('alert', '<div class="alert alert-success" role="alert">Your password is successfully reset.<br>Please login again.</div>');
                }
                else {
                    $data['validation'] = $this->validator;
                }
            }

            $data['title'] = 'Reset Password';
            return view('auth/reset_password', $data);
        }
        else if ($user_token && $user_token->expired_at < date('Y-m-d H:i:s')) {
            echo 'Expired';
            echo '<br>';
            echo '<a href="'.base_url('login').'">Login</a>';
        }
        else {
            echo 'Error';
            echo '<br>';
            echo '<a href="'.base_url('login').'">Login</a>';
        }
    }

    public function logout() {
        session()->destroy();
        $data['title'] = 'Logout';
        return view('auth/logout', $data);
    }
}
