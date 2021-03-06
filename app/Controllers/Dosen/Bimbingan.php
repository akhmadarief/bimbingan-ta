<?php

namespace App\Controllers\Dosen;

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
        $data['bimbingan']  = $this->bimbingan_model->detail_bimbingan('id_dosen='.session('id').' AND (status=0 OR status=3)')->getResult();

        return view('bimbingan/bimbingan_list', $data);
    }

    public function on_progress() {
        $data['title']      = 'Bimbingan Berjalan';
        $data['bimbingan']  = $this->bimbingan_model->detail_bimbingan(['id_dosen' => session('id'), 'status' => 1])->getResult();

        return view('bimbingan/bimbingan_list', $data);
    }

    public function completed() {
        $data['title']      = 'Bimbingan Selesai';
        $data['bimbingan']  = $this->bimbingan_model->detail_bimbingan(['id_dosen' => session('id'), 'status' => 2])->getResult();

        return view('bimbingan/bimbingan_list', $data);
    }

    public function approve($id = NULL) {

        if ($this->bimbingan_model->where('id='.$id.' AND id_dosen='.session('id').' AND (status=0 OR status=3)')->first()) {
            $this->bimbingan_model->save(['id' => $id, 'status' => 1]);
            return redirect()->to(base_url('dosen/bimbingan/on-progress'))->with('toastr', 'toastr.success("Berhasil menyetujui pengajuan bimbingan")');
        }
        else {
            return redirect()->back()->with('toastr', 'toastr.error("Tidak dapat menyetujui pengajuan bimbingan")');
        }
    }

    public function cancel_approve($id = NULL) {

        if ($this->bimbingan_model->where(['id' => $id, 'id_dosen' => session('id'), 'status' => 1])->first()) {
            $this->bimbingan_model->save(['id' => $id, 'status' => 0]);
            return redirect()->to(base_url('dosen/bimbingan/submission'))->with('toastr', 'toastr.success("Berhasil membatalkan persetujuan pengajuan bimbingan")');
        }
        else {
            return redirect()->back()->with('toastr', 'toastr.error("Tidak dapat membatalkan persetujuan pengajuan bimbingan")');
        }
    }

    public function reject($id = NULL) {

        if ($this->bimbingan_model->where(['id' => $id, 'id_dosen' => session('id'), 'status' => 0])->first()) {
            $this->bimbingan_model->save(['id' => $id, 'status' => 3]);
            return redirect()->to(base_url('dosen/bimbingan/submission'))->with('toastr', 'toastr.success("Berhasil menolak pengajuan bimbingan")');
        }
        else {
            return redirect()->back()->with('toastr', 'toastr.error("Tidak dapat menolak pengajuan bimbingan")');
        }
    }

    public function mark_as_completed($id = NULL) {

        if ($this->bimbingan_model->where(['id' => $id, 'id_dosen' => session('id'), 'status' => 1])->first()) {
            $this->bimbingan_model->save(['id' => $id, 'status' => 2]);
            return redirect()->to(base_url('dosen/bimbingan/completed'))->with('toastr', 'toastr.success("Berhasil menyelesaikan bimbingan")');
        }
        else {
            return redirect()->back()->with('toastr', 'toastr.error("Tidak dapat menyelesaikan bimbingan")');
        }
    }

    public function mark_as_on_progress($id = NULL) {

        if ($this->bimbingan_model->where(['id' => $id, 'id_dosen' => session('id'), 'status' => 2])->first()) {
            $this->bimbingan_model->save(['id' => $id, 'status' => 1]);
            return redirect()->to(base_url('dosen/bimbingan/on-progress'))->with('toastr', 'toastr.success("Berhasil membatalkan penyelesaian bimbingan")');
        }
        else {
            return redirect()->back()->with('toastr', 'toastr.error("Tidak dapat membatalkan penyelesaian bimbingan")');
        }
    }

    public function detail() {
        $data['title'] = 'Detail Bimbingan';
        return view('detail_bimbingan', $data);
    }
}
