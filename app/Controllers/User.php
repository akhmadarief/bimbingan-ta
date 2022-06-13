<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController {

    public function __construct() {
        $this->user_model = new UserModel();
    }

    public function settings() {
        $data['title'] = 'User Settings';
        $data['user'] = $this->user_model->find(session('id'));
        return view('user/settings', $data);
    }

    public function update_profile() {

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name'      => 'required|min_length[3]|max_length[60]',
                'nip/nim'   => 'required|min_length[14]|max_length[20]|is_natural'
            ];

            if ($this->validate($rules)) {
                $id         = session('id');
                $name       = $this->request->getPost('name');
                $nip_nim    = $this->request->getPost('nip/nim');

                $this->user_model->save(['id' => $id, 'name' => $name, 'nip_nim' => $nip_nim]);
                session()->set('name', $name);
                session()->setFlashdata('toastr', 'toastr.success("Berhasil memperbarui profil")');
            }
            else {
                session()->setFlashdata('alert_profile', '<div class="alert alert-danger" style="padding-bottom: 0" role="alert">'.$this->validator->listErrors().'</div>');
            }
        }

        return redirect()->to(base_url('user/settings'));
    }

    public function update_password() {

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'new_password'      => 'required|min_length[6]|max_length[60]',
                'confirm_password'  => 'matches[new_password]'
            ];

            if ($this->validate($rules)) {
                $id             = session('id');
                $old_password   = $this->request->getPost('old_password');
                $new_password   = $this->request->getPost('new_password');

                $user = $this->user_model->find($id);

                if ($user && password_verify($old_password, $user->password)) {
                    $this->user_model->save(['id' => $id, 'password' => password_hash($new_password, PASSWORD_BCRYPT)]);
                    session()->setFlashdata('toastr', 'toastr.success("Berhasil mengubah password")');
                }
                else {
                    session()->setFlashdata('alert_password', '<div class="alert alert-danger" role="alert">Wrong old password.</div>');
                }
            }
            else {
                session()->setFlashdata('alert_password', '<div class="alert alert-danger" style="padding-bottom: 0" role="alert">'.$this->validator->listErrors().'</div>');
            }
        }

        return redirect()->to(base_url('user/settings'));
    }
}
