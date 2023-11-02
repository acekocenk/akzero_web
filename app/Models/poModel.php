<?php

namespace App\Models;

use CodeIgniter\Model;

class poModel extends Model
{
    protected $table = 'po';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = ['potype', 'pono', 'podate', 'indate', 'currency', 'supplierid', 'usersid', 'discount', 'ppn', 'terbilang', 'postatus'];

    public function poList($pono = false)
    {
        if ($pono == false) {
            $this->orderby('pono');
            return $this->findAll();
        }

        return $this->where(['pono' => $pono])->first();
    }

    public function poListajax()
    {
        $sql = 'SELECT 
        po.id AS poid,
        po.potype,
        po.pono,
        po.podate,
        po.indate,
        po.currency,
        supplier.id AS supplierid,
        supplier.suppliername,
        users.id AS usersid,
        users.fullname,
        po.discount,
        po.ppn,
        (COALESCE(t1.grandtotal,0)+((COALESCE(t1.grandtotal,0)*COALESCE(po.ppn,0))/100))-COALESCE(po.discount,0) AS grandtotal,
        po.terbilang,
        po.postatus FROM po
        LEFT JOIN (select poid, SUM(qtyprice * price) AS grandtotal FROM po_detail GROUP BY poid) AS t1 ON t1.poid = po.id 
        LEFT JOIN supplier ON po.supplierid = supplier.id 
        INNER JOIN users ON po.usersid = users.id';
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getPONO($potype)
    {
        $sql = 'SELECT MAX(RIGHT(pono,4)) AS kd_max FROM po WHERE DATE_FORMAT(podate, "%Y") = DATE_FORMAT(CURDATE(),"%Y") AND potype = "' . $potype . '";';
        $q = $this->db->query($sql);

        $kd = "";
        $tp = "";
        if ($q->getNumRows() > 0) {
            foreach ($q->getResult() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        if ($potype == "Local") {
            $tp = "LK";
        } elseif ($potype == "Import") {
            $tp = "IM";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "BIG" . $tp . date('ym') .  "-" . $kd;
    }

    function getPO($pono)
    {
        $builder = $this->db->table('po');
        $query = $builder->getWhere(['pono' => $pono]);
        if ($query->getNumRows() > 0) {
            foreach ($query->getResult() as $data) {
                $rsl = array(
                    'id' => $data->id,
                    'potype' => $data->potype,
                    'pono' => $data->pono,
                    'podate' => $data->podate,
                    'indate' => $data->indate,
                    'currency' => $data->currency,
                    'supplierid' => $data->supplierid,
                    'usersid' => $data->usersid,
                    'discount' => $data->discount,
                    'ppn' => $data->ppn,
                    'terbilang' => $data->terbilang,
                    'postatus' => $data->postatus,
                );
            }
        }
        return $rsl;
    }
}
