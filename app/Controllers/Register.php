<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\TokenModel;

class Register extends BaseController {

    public function __construct() {
        $this->user_model   = new UserModel();
        $this->token_model  = new TokenModel();
    }

    public function index() {

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name'              => 'required|min_length[3]|max_length[60]',
                'nip_nim'           => 'required|min_length[14]|max_length[18]|is_natural|is_unique[user.nip_nim]',
                'email'             => 'required|min_length[6]|max_length[60]|valid_email|is_unique[user.email]',
                'password'          => 'required|min_length[6]|max_length[60]',
                'confirm_password'  => 'matches[password]',
                'role'              => 'required|min_length[3]|max_length[5]',
            ];

            if ($this->validate($rules)) {
                $name               = $this->request->getPost('name');
                $nip_nim            = $this->request->getPost('nip_nim');
                $user_email         = $this->request->getPost('email');
                $password           = $this->request->getPost('password');
                $confirm_password   = $this->request->getPost('confirm_password');
                $role               = $this->request->getPost('role');
                $token              = md5(rand());
                $expired_at         = date('Y-m-d H:i:s', strtotime('1 hour'));

                $this->user_model->insert([
                    'name'      => $name,
                    'nip_nim'   => $nip_nim,
                    'email'     => $user_email,
                    'password'  => password_hash($password, PASSWORD_BCRYPT),
                    'role'      => $role
                ]);

                $this->token_model->insert([
                    'user_email'    => $user_email,
                    'type'          => 0,
                    'token'         => $token,
                    'expired_at'    => $expired_at
                ]);

                $email = \Config\Services::email();

                $email->setTo($user_email);
                $email->setSubject('Konfirmasi Registrasi');
                $email->setMessage('Testing the email class.<br><a href="'.base_url('register/verify/'.$token).'" target="_blank">Confirm</a>');

                if ($email->send()) {
                    $data['title'] = 'Confirm Mail';
                    $data['email'] = $user_email;
                    $data['msg'] = 'Please click on the included link to activate your account.';
                    return view('register/confirm_mail', $data);
                } 
                else {
                    $data = $email->printDebugger(['headers']);
                    return print_r($data);
                }
            }
            else {
                $data['validation'] = $this->validator;
            }
        }

        $data['title'] = 'Register';
        return view('register/index', $data);
    }

    public function verify($token = NULL) {

        $user_token = $this->token_model->where(['token' => $token, 'type' => 0])->first();

        if ($user_token && $user_token->expired_at > date('Y-m-d H:i:s')) {

            $this->user_model->where(['email' => $user_token->user_email])->set(['email_verified' => 1])->update();

            session()->remove(['id', 'name', 'email', 'logged_in']);
            return redirect()->to(base_url('login'))->with('alert', '<div class="alert alert-success" role="alert">Your Email Address is successfully verified.<br>Please login to access your account.</div>');
        }
        else if ($user_token && $user_token->expired_at < date('Y-m-d H:i:s')) {
            echo 'Expired.';
            echo '<br>';
            echo '<a href="'.base_url('login').'">Login</a>';
        }
        else {
            echo 'Sorry, there is error verifying your Email Address.';
            echo '<br>';
            echo '<a href="'.base_url('login').'">Login</a>';
        }
    }
}
