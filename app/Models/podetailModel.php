<?php

namespace App\Models;

use CodeIgniter\Model;

class podetailModel extends Model
{
    protected $table = 'po_detail';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = ['itemcode', 'itemname', 'qty', 'unit', 'qty2', 'unit2', 'qtyprice', 'unittqtyprice', 'price', 'total'];

    public function podetailList($pono = false)
    {
        if ($pono == false) {
            $this->orderby('itemcode');
            return $this->findAll();
        }

        return $this->where(['poid' => $pono])->first();
    }

    public function podetailListajax()
    {
        $builder = $this->db->table('po_detail');
        $query = $builder->get();

        return $query->getResult();
    }
}
