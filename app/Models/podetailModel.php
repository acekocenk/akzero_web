<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use SebastianBergmann\Comparator\NumericComparator;

class podetailModel extends Model
{
    protected $table = 'po_detail';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = ['poid', 'itemcode', 'itemname', 'qty', 'unit', 'qty2', 'unit2', 'qtyprice', 'qtypriceunit', 'price', 'total',];

    public function podetailList($poid = false)
    {
        if ($poid == false) {
            $this->orderby('itemcode');
            return $this->findAll();
        }

        return $this->where(['poid' => $poid])->first();
    }

    public function podetailListajax($poid = false)
    {
        $builder = $this->db->table('po_detail');
        // if ($poid == false) {
        //     $query = $builder->get();
        // } else {
        $query = $builder->getWhere(['poid' => $poid]);
        // }
        return $query->getResult();
    }

    function getPoDetail($id)
    {
        $builder = $this->db->table('po_detail');
        $query = $builder->getWhere(['id' => $id]);
        if ($query->getNumRows() > 0) {
            foreach ($query->getResult() as $data) {
                $rsl = array(
                    'id' => $data->id,
                    'poid' => $data->poid,
                    'itemcode' => $data->itemcode,
                    'itemname' => $data->itemname,
                    'qty' => $data->qty,
                    'unit' => $data->unit,
                    'qty2' => $data->qty2,
                    'unit2' => $data->unit2,
                    'qtyprice' => $data->qtyprice,
                    'qtypriceunit' => $data->qtypriceunit,
                    'price' => $data->price,
                    'total' => $data->total,
                );
            }
        }
        return $rsl;
    }

    function getPoDetailSUM($id)
    {
        $sql = 'SELECT sum(qtyprice * price) AS grandtotal FROM po_detail WHERE poid = "' . $id . '"';
        $query = $this->db->query($sql);
        $grandtotal = "";
        if ($query->getNumRows() > 0) {
            foreach ($query->getResult() as $gt) {
                $grandtotal = ($gt->grandtotal);
            }
        } else {
            $grandtotal = "0";
        }

        return $grandtotal;
    }
}
