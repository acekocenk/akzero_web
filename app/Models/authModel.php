<?php

namespace App\Models;

use CodeIgniter\Model;

class authModel extends Model
{
    public function getUserGroup($userid = false)
    {
        if ($userid == false) {
            $builder = $this->db->table('auth_groups_users');
            $builder->select('auth_groups.id as groupsid, users.id as userid, users.username, users.email, users.fullname, users.userimg, auth_groups.name');
            $builder->join('users', 'auth_groups_users.user_id = users.id');
            $builder->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id');
            $query = $builder->get();

            return $query->getResult();
        }

        $builder = $this->db->table('auth_groups_users');
        $builder->select('auth_groups.id as groupsid, users.id as userid, users.username, users.email, users.fullname, users.userimg, auth_groups.name');
        $builder->join('users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id');
        $builder->where('users.id', $userid);
        $query = $builder->get();

        return $query->getRowObject();
    }
}
