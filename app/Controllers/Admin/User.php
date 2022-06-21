<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\TokenModel;

class User extends BaseController {

    public function __construct() {
        $this->user_model   = new UserModel();
        $this->token_model  = new TokenModel();
    }

    public function dosen() {
        $data['title'] = 'Dosen';
        $data['user'] = $this->user_model->where(['role' => 'dosen'])->findAll();

        return view('user/user', $data);
    }

    public function mhs() {
        $data['title'] = 'Mahasiswa';
        $data['user'] = $this->user_model->where(['role' => 'mhs'])->findAll();

        return view('user/user', $data);
    }

    public function add() {

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name'      => 'required|min_length[3]|max_length[60]',
                'nip/nim'   => 'required|min_length[14]|max_length[20]|is_natural',
                'email'     => 'required|min_length[6]|max_length[60]|valid_email|is_unique[user.email]',
                'password'  => 'required|min_length[6]|max_length[60]',
                'role'      => 'required|min_length[3]|max_length[5]',
            ];

            if ($this->validate($rules)) {
                $name               = $this->request->getPost('name');
                $nip_nim            = $this->request->getPost('nip/nim');
                $user_email         = $this->request->getPost('email');
                $password           = $this->request->getPost('password');
                $role               = $this->request->getPost('role');
                $token              = md5($user_email.rand());
                $expired_at         = date('Y-m-d H:i:s');

                $this->user_model->insert([
                    'name'              => $name,
                    'nip_nim'           => $nip_nim,
                    'email'             => $user_email,
                    'email_verified'    => 1,
                    'password'          => $password,
                    'role'              => $role
                ]);

                return redirect()->to(base_url('admin/user/'.$role))->with('toastr', 'toastr.success("Berhasil menambah '.$role.' baru")');
            }
            else {
                return redirect()->back()->withInput()->with('alert_add_user', '<div class="alert alert-danger" style="padding-bottom: 0" role="alert">'.$this->validator->listErrors().'</div>');
            }
        }
    }
}
