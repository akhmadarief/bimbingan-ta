<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
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
                'nip/nim'           => 'required|min_length[14]|max_length[20]|is_natural',
                'email'             => 'required|min_length[6]|max_length[60]|valid_email|is_unique[user.email]',
                'password'          => 'required|min_length[6]|max_length[60]',
                'confirm_password'  => 'matches[password]',
                'role'              => 'required|min_length[3]|max_length[5]',
            ];

            if ($this->validate($rules)) {
                $name               = $this->request->getPost('name');
                $nip_nim            = $this->request->getPost('nip/nim');
                $email         = $this->request->getPost('email');
                $password           = $this->request->getPost('password');
                $confirm_password   = $this->request->getPost('confirm_password');
                $role               = $this->request->getPost('role');
                $token              = md5($user_email.rand());
                $expired_at         = date('Y-m-d H:i:s', strtotime('1 hour'));

                $this->user_model->insert([
                    'name'      => $name,
                    'nip_nim'   => $nip_nim,
                    'email'     => $email,
                    'password'  => $password,
                    'role'      => $role
                ]);

                $this->token_model->insert([
                    'email'         => $email,
                    'type'          => 0,
                    'token'         => $token,
                    'expired_at'    => $expired_at
                ]);

                $url = base_url('register/verify/'.$token);

                return $this->sendVerifyEmailAddress($email, $url);
            }
            else {
                return redirect()->back()->withInput()->with('alert', '<div class="alert alert-danger pb-0" role="alert">'.$this->validator->listErrors().'</div>');
            }
        }

        $data['title'] = 'Register';
        return view('auth/register', $data);
    }

    public function verify($token = NULL) {

        $token_data = [
            'token'         => $token,
            'type'          => 0,
            'expired_at >'  => date('Y-m-d H:i:s')
        ];

        $valid_token = $this->token_model->where($token_data)->first();

        if ($valid_token) {

            $this->user_model->where(['email' => $valid_token->email])->set(['email_verified' => 1])->update();

            $this->token_model->delete($valid_token->email);

            return redirect()->to(base_url('login'))->with('alert', '<div class="alert alert-success" role="alert">Your Email Address is successfully verified.<br>Please login to access your account.</div>');
        }
        else {
            return redirect()->to(base_url('login'))->with('alert', '<div class="alert alert-danger" role="alert">The link you followed has expired or not valid.</div>');
        }
    }

    private function sendVerifyEmailAddress($user_email, $url) {
        $view = \Config\Services::renderer();
        $view->setData(['url' => $url]);
        $email_msg = $view->render('auth/verify_email_address');

        $email = \Config\Services::email();
        $email->setTo($user_email);
        $email->setSubject('Verify Email Address');
        $email->setMessage($email_msg);

        if ($email->send()) {
            $data['title'] = 'Confirm Mail';
            $data['email'] = $user_email;
            $data['msg'] = 'Please click on the included link to activate your account.';

            return view('auth/confirm_mail', $data);
        }
        else {
            $data = $email->printDebugger(['headers']);
            return print_r($data);
        }
    }
}
