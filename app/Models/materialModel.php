<?php

namespace App\Models;

use CodeIgniter\Model;

class materialModel extends Model
{
    protected $table = 'material';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = ['materialcode', 'materialname', 'slug'];

    public function materialList($slug = false)
    {
        if ($slug == false) {
            $this->orderby('materialname');
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function materialDataTable()
    {
        $builder = $this->db->table('material');
        $query = $builder->get();

        return $query->getResult();
    }
    // public function materialInsert()
    // {
    //     $data = [
    //         "materialcode" => $this->input->post('materialcode', true),
    //         "materialname" => $this->input->post('materialname', true),
    //         "slug" => $this->input->post('slug', true)
    //     ];
    //     return $this->save($data);
    // }

    // public function materialUpdate()
    // {
    //     $data = [
    //         "id" => $this->input->post('id', true),
    //         "materialcode" => $this->input->post('materialcode', true),
    //         "materialname" => $this->input->post('materialname', true),
    //         "slug" => $this->input->post('slug', true)
    //     ];
    //     return $this->save($data);
    // }

    // public function materialDelete()
    // {
    //     $data = [
    //         "id" => $this->input->post('id', true)
    //     ];
    //     return $this->delete($data);
    // }
}
