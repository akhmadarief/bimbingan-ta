<?php

namespace App\Models;
use CodeIgniter\Model;

class BimbinganModel extends Model {
    protected $table            = 'bimbingan';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'id_dosen', 'id_mhs', 'jenis', 'topik', 'status'];
    protected $useTimestamps    = true;

    public function detail_bimbingan($where = '1 = 1') {
        $builder = $this->db->table('bimbingan');
        $builder->select('bimbingan.id, id_dosen, dosen.nip_nim as nip, dosen.name as dosen, id_mhs, mhs.nip_nim as nim, mhs.name as mhs, jenis, topik, bimbingan.created_at');
        $builder->join('user as dosen', 'bimbingan.id_dosen = dosen.id');
        $builder->join('user as mhs', 'bimbingan.id_mhs = mhs.id');
        $builder->where($where);
        $builder->orderBy('bimbingan.created_at', 'DESC');
        $query = $builder->get();
        return $query;
    }
}
