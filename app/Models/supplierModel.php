<?php

namespace App\Models;

use CodeIgniter\Model;

class supplierModel extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = ['suppliername', 'address', 'telp', 'email', 'acccode', 'slug'];

    public function supplierList($slug = false)
    {
        if ($slug == false) {
            $this->orderby('suppliername');
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function hutimasList()
    {
        $db = \Config\Database::connect('second');
        // $seconddb = $db->load->database('second', true);
        $db->reconnect();
        $query = $db->db->query('select H_KODE, H_NAMA from hutimas order by H_KODE asc;');

        return $query->result();
    }
}
