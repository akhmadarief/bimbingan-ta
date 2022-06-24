<?php

namespace App\Controllers\Auth\Google;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Google\Client;
use Google\Service\Oauth2;

class Register extends BaseController {

    public function index() {

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

                $user_model = new UserModel();
                $user_model->where(['email' => $email])->set(['name' => $name, 'nip_nim' => $nip_nim, 'email_verified' => 1])->update();

                $user = $user_model->where(['email' => $email])->first();

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
                return redirect()->back()->withInput()->with('alert', '<div class="alert alert-danger pb-0" role="alert">'.$this->validator->listErrors().'</div>');
            }
        }

        $data['title'] = 'Register with Google';
        $data['google_user'] = $google_user;

        return view('auth/register', $data);
    }
}
