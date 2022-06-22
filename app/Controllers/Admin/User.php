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
                $name       = $this->request->getPost('name');
                $nip_nim    = $this->request->getPost('nip/nim');
                $email      = $this->request->getPost('email');
                $password   = $this->request->getPost('password');
                $role       = $this->request->getPost('role');

                $this->user_model->insert([
                    'name'              => $name,
                    'nip_nim'           => $nip_nim,
                    'email'             => $email,
                    'email_verified'    => 1,
                    'password'          => $password,
                    'role'              => $role
                ]);

                return redirect()->to(base_url('admin/user/'.$role))->with('toastr', 'toastr.success("Berhasil menambah '.$role.' baru")');
            }
            else {
                return redirect()->back()->withInput()->with('alert_add_user', '<div class="alert alert-danger pb-0" role="alert">'.$this->validator->listErrors().'</div>');
            }
        }
    }

    public function edit() {

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id'        => 'required|is_natural',
                'name'      => 'required|min_length[3]|max_length[60]',
                'nip/nim'   => 'required|min_length[14]|max_length[20]|is_natural',
                'email'     => 'required|min_length[6]|max_length[60]|valid_email|is_unique[user.email,id,{id}]',
                'verified'  => 'required|min_length[1]|max_length[1]|is_natural',
                'role'      => 'required|min_length[3]|max_length[5]',
            ];

            $this->request->getPost('password') == '' ?: $rules['password'] = 'required|min_length[6]|max_length[60]';

            if ($this->validate($rules)) {
                $id         = $this->request->getPost('id');
                $name       = $this->request->getPost('name');
                $nip_nim    = $this->request->getPost('nip/nim');
                $email      = $this->request->getPost('email');
                $verified   = $this->request->getPost('verified');
                $password   = $this->request->getPost('password');
                $role       = $this->request->getPost('role');

                $user = $this->user_model->find($id);

                if ($user) {
                    $user_data = [
                        'id'                => $id,
                        'name'              => $name,
                        'nip_nim'           => $nip_nim,
                        'email'             => $email,
                        'email_verified'    => $verified,
                        'role'              => $role
                    ];

                    $password == '' ?: $user_data['password'] = $password;

                    $this->user_model->save($user_data);

                    return redirect()->to(base_url('admin/user/'.$role))->with('toastr', 'toastr.success("Berhasil memperbarui user '.$user->name.'")');
                }
                else {
                    return redirect()->back()->with('toastr', 'toastr.error("Gagal memperbarui user")');
                }
            }
            else {
                return redirect()->back()->withInput()->with('alert_edit_user', '<div class="alert alert-danger pb-0" role="alert">'.$this->validator->listErrors().'</div>');
            }
        }
    }

    public function delete($id = NULL) {

        $user = $this->user_model->find($id);

        if ($user) {
            $this->user_model->delete($id);
            return redirect()->back()->with('toastr', 'toastr.success("Berhasil menghapus user '.$user->name.'")');
        }
        else {
            return redirect()->back()->with('toastr', 'toastr.error("Gagal menghapus user")');
        }
    }
}
