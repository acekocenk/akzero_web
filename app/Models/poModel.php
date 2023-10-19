<?php

namespace App\Models;

use CodeIgniter\Model;

class poModel extends Model
{
    protected $table = 'po';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = ['pono', 'podate', 'indate', 'currency', 'supplierid', 'usersid', 'discount', 'ppn', 'terbilang', 'postatus'];

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
        `po`.`id` AS `poid`,
        `po`.`pono` AS `pono`,
        `po`.`podate`,
        `po`.`indate`,
        `po`.`currency`,
        `supplier`.`id` AS `supplierid`,
        `supplier`.`suppliername`,
        `users`.`id` AS `usersid`,
        `users`.`fullname`,
        `po`.`discount`,
        `po`.`ppn`,
        COALESCE(`t1`.`grandtotal`,0) AS `grandtotal`, 
        `po`.`terbilang`,
        `po`.`postatus` FROM `po`
        LEFT JOIN (select `poid`, `qtyprice` * `price` AS `grandtotal` FROM `po_detail`) AS `t1` ON `t1`.`poid` = `po`.`id` 
        INNER JOIN `supplier` ON `po`.`supplierid` = `supplier`.`id` 
        INNER JOIN `users` ON `po`.`usersid` = `users`.`id`';
        $query = $this->db->query($sql);
        return $query->getResult();
    }
}
