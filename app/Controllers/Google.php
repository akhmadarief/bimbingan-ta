<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TokenModel;
use Google\Client;
use Google\Service\Oauth2;

class Google extends BaseController {

    public function __construct() {
        $this->user_model   = new UserModel();
        $this->token_model  = new TokenModel();
    }

    public function auth() {

        $client_id      = '714503460771-6f8jc6f703oi5idra9hk46plcc1tb716.apps.googleusercontent.com';
        $client_secret  = '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';
        $redirect_uri   = base_url('google/auth');

        $client = new Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope('email');
        $client->addScope('profile');
        $client->setPrompt('select_account');

        if (isset($_GET['code'])) {

            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

            if (isset($token['access_token'])) {

                session()->set('access_token', $token['access_token']);

                $client->setAccessToken($token['access_token']);

                $Oauth2 = new Oauth2($client);
                $google_user = $Oauth2->userinfo->get();

                $user = $this->user_model->where('email', $google_user->email)->first();

                if (!$user) {
                    $this->user_model->insert([
                        'name'      => $google_user->name,
                        'email'     => $google_user->email,
                        'password'  => $this->generateRandomString(),
                        'role'      => $google_user->hd == 'student.ce.undip.ac.id' ? 'mhs' : 'dosen',
                    ]);

                    return redirect()->to(base_url('google/register'))->with('alert', '<div class="alert alert-warning" role="alert">Please complete your profile.</div>');
                }

                else if ($user && $user->email_verified == 0) {
                    return redirect()->to(base_url('google/register'))->with('alert', '<div class="alert alert-warning" role="alert">Please complete your profile.</div>');
                }

                else if ($user && $user->email_verified == 1) {
                    session()->remove('access_token');

                    session()->set([
                        'id'        => $user->id,
                        'name'      => $user->name,
                        'email'     => $user->email,
                        'role'      => $user->role,
                        'picture'   => $google_user->picture,
                        'logged_in' => true
                    ]);

                    return redirect()->to(base_url(session('role').'/dashboard'))->with('toastr', 'toastr.success("Selamat datang, '.$user->name.'")');
                }
            }
        }

        else {
            return redirect()->to($client->createAuthUrl());
        }
    }

    public function register() {

        if (!session('access_token')){
            return redirect()->to(base_url('login'));
        }

        $client = new Client();
        $client->setAccessToken(session('access_token'));

        $Oauth2 = new Oauth2($client);
        $google_user = $Oauth2->userinfo->get();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name'      => 'required|min_length[3]|max_length[60]',
                'nip/nim'   => 'required|min_length[14]|max_length[20]|is_natural',
            ];

            if ($this->validate($rules)) {
                $email      = $google_user->email;
                $name       = $this->request->getPost('name');
                $nip_nim    = $this->request->getPost('nip/nim');

                $this->user_model->where(['email' => $email])->set(['name' => $name, 'nip_nim' => $nip_nim, 'email_verified' => 1])->update();

                $user = $this->user_model->where(['email' => $email])->first();

                session()->remove('access_token');

                session()->set([
                    'id'        => $user->id,
                    'name'      => $user->name,
                    'email'     => $email,
                    'role'      => $user->role,
                    'picture'   => $google_user->picture,
                    'logged_in' => true
                ]);

                return redirect()->to(base_url(session('role').'/dashboard'))->with('toastr', 'toastr.success("Selamat datang, '.$user->name.'")');
            }
            else {
                return redirect()->back()->withInput()->with('alert', '<div class="alert alert-danger" style="padding-bottom: 0" role="alert">'.$this->validator->listErrors().'</div>');
            }
        }

        $data['title'] = 'Register with Google';
        $data['google_user'] = $google_user;

        return view('auth/register', $data);
    }

    private function generateRandomString($length = 10) {
        $characters         = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength   = strlen($characters);
        $randomString       = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
