<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\TokenModel;

class Password extends BaseController {

    public function __construct() {
        $this->user_model   = new UserModel();
        $this->token_model  = new TokenModel();
    }

    public function forgot(){

        $throttler = \Config\Services::throttler();

        if ($this->request->getMethod() == 'post') {

            $throttler = \Config\Services::throttler();

            if ($throttler->check(md5($this->request->getIPAddress()), 5, 300)) {

                $user = $this->user_model->where(['email' => $this->request->getPost('email'), 'email_verified' => 1])->first();

                if ($user) {
                    $token      = md5($user->email.rand());
                    $expired_at = date('Y-m-d H:i:s', strtotime('1 hour'));

                    $token_data = [
                        'email'         => $user->email,
                        'type'          => 1,
                        'token'         => $token,
                        'expired_at'    => $expired_at
                    ];

                    $token_exist = $this->token_model->find($user->email);

                    if ($token_exist) {
                        $this->token_model->save($token_data);
                    }
                    else {
                        $this->token_model->insert($token_data);
                    }

                    $url = base_url('reset-password/'.$token);

                    return $this->sendResetPasswordNotification($user->email, $url);
                }
                else {
                    return redirect()->to(base_url('forgot-password'))->with('alert', '<div class="alert alert-danger" role="alert">Your email is not registered.</div>');
                }
            }
            else {
                return redirect()->back()->with('alert', '<div class="alert alert-danger" role="alert">You requested too many times.<br>Please wait for 5 minutes.</div>');
            }
        }

        $data['title'] = 'Forgot Password';
        return view('auth/forgot_password', $data);
    }

    public function reset($token = NULL) {

        $token_data = [
            'token'         => $token,
            'type'          => 1,
            'expired_at >'  => date('Y-m-d H:i:s')
        ];

        $valid_token = $this->token_model->where($token_data)->first();

        if ($valid_token) {

            if ($this->request->getMethod() == 'post') {
                $rules = [
                    'password'          => 'required|min_length[6]|max_length[60]',
                    'confirm_password'  => 'matches[password]'
                ];

                if ($this->validate($rules)) {
                    $this->user_model->where(['email' => $valid_token->email])->set(['password' => $this->request->getPost('password')])->update();

                    $this->token_model->delete($valid_token->email);

                    return redirect()->to(base_url('login'))->with('alert', '<div class="alert alert-success" role="alert">Your password is successfully reset.<br>Please login again.</div>');
                }
                else {
                    $data['validation'] = $this->validator;
                }
            }

            $data['title'] = 'Reset Password';
            return view('auth/reset_password', $data);
        }
        else {
            return redirect()->to(base_url('forgot-password'))->with('alert', '<div class="alert alert-danger" role="alert">The link you followed has expired or not valid.</div>');
        }
    }

    private function sendResetPasswordNotification($user_email, $url) {
        $view = \Config\Services::renderer();
        $view->setData(['url' => $url]);
        $email_msg = $view->render('auth/reset_password_notification');

        $email = \Config\Services::email();
        $email->setTo($user_email);
        $email->setSubject('Reset Password Notification');
        $email->setMessage($email_msg);

        if ($email->send()) {
            $data['title'] = 'Confirm Mail';
            $data['email'] = $user_email;
            $data['msg'] = 'Please click on the included link to reset your password.';

            return view('auth/confirm_mail', $data);
        }
        else {
            $data = $email->printDebugger(['headers']);
            return print_r($data);
        }
    }
}
