<?php

namespace App\Controllers\Mhs;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\BimbinganModel;

class Bimbingan extends BaseController {

    public function __construct() {
        $this->user_model       = new UserModel();
        $this->bimbingan_model  = new BimbinganModel();
    }

    public function submission() {
        $data['title']      = 'Pengajuan Bimbingan';
        $data['bimbingan']  = $this->bimbingan_model->detail_bimbingan('id_mhs='.session('id').' AND (status=0 OR status=3)')->getResult();
        $data['dosen']  = $this->user_model->where(['role' => 'dosen'])->findAll();

        return view('bimbingan/bimbingan_list', $data);
    }

    public function on_progress() {
        $data['title']      = 'Bimbingan Berjalan';
        $data['bimbingan']  = $this->bimbingan_model->detail_bimbingan(['id_mhs' => session('id'), 'status' => 1])->getResult();
        $data['dosen']  = $this->user_model->where(['role' => 'dosen'])->findAll();

        return view('bimbingan/bimbingan_list', $data);
    }

    public function completed() {
        $data['title']      = 'Bimbingan Selesai';
        $data['bimbingan']  = $this->bimbingan_model->detail_bimbingan(['id_mhs' => session('id'), 'status' => 2])->getResult();
        $data['dosen']  = $this->user_model->where(['role' => 'dosen'])->findAll();

        return view('bimbingan/bimbingan_list', $data);
    }

    public function add() {

        $dosen  = $this->request->getPost('dosen');
        $jenis  = $this->request->getPost('jenis');
        $topik  = $this->request->getPost('topik');

        $this->bimbingan_model->insert([
            'id_dosen'      => $dosen,
            'id_mhs'        => session('id'),
            'jenis'         => $jenis,
            'topik'         => $topik,
            'status'        => 0
        ]);

        return redirect()->to(base_url('mhs/bimbingan/submission'))->with('toastr', 'toastr.success("Berhasil membuat bimbingan baru")');
    }

    public function detail() {
        $data['title'] = 'Detail Bimbingan';
        return view('detail_bimbingan', $data);
    }
}
