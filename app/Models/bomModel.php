<?php

namespace App\Models;

use CodeIgniter\Model;

class bomModel extends Model
{
    protected $table = 'bom';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = ['bomcode', 'bomname', 'categorycode', 'materialcode', 'materialtypecode', 'colourcode', 'unit', 'slug', 'bomimg'];

    public function bomList($slug = false)
    {
        if ($slug == false) {
            $this->orderby('bomname');
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function bomListajax()
    {
        $builder = $this->db->table('bom');
        $query = $builder->get();

        return $query->getResult();
    }

    // public function bomInsert()
    // {
    //     $data = [
    //         "bomcode" => $this->input->post('bomcode', true),
    //         "bomname" => $this->input->post('bomname', true),
    //         "slug" => $this->input->post('slug', true)
    //     ];
    //     return $this->save($data);
    // }

    // public function bomUpdate()
    // {
    //     $data = [
    //         "id" => $this->input->post('id', true),
    //         "bomcode" => $this->input->post('bomcode', true),
    //         "bomname" => $this->input->post('bomname', true),
    //         "slug" => $this->input->post('slug', true)
    //     ];
    //     return $this->save($data);
    // }

    // public function bomDelete()
    // {
    //     $data = [
    //         "id" => $this->input->post('id', true)
    //     ];
    //     return $this->delete($data);
    // }
}
