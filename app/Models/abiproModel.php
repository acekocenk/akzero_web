<?php

namespace App\Models;

use CodeIgniter\Model;

class abiproModel extends Model
{
    protected $DBGroup = 'second';
    protected $table = 'hutimas';
    // protected $primaryKey = 'id';
    // protected $useTimestamps = true;

    // protected $allowedFields = ['abiproname', 'address', 'telp', 'email', 'acccode', 'slug'];

    public function hutimasList()
    {
        // if ($slug == false) {
        $this->orderby('H_KODE');
        return $this->findAll();
        // }

        // return $this->where(['slug' => $slug])->first();
    }
}
