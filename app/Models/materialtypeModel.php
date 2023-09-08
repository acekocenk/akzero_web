<?php

namespace App\Models;

use CodeIgniter\Model;

class materialtypeModel extends Model
{
    protected $table = 'materialtype';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = ['materialtypecode', 'materialtypename', 'slug'];

    public function materialtypeList($slug = false)
    {
        if ($slug == false) {
            $this->orderby('materialtypename');
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function materialtypeDataTable()
    {
        $builder = $this->db->table('materialtype');
        $query = $builder->get();

        return $query->getResult();
    }

    // public function materialtypeInsert()
    // {
    //     $data = [
    //         "materialtypecode" => $this->input->post('materialtypecode', true),
    //         "materialtypename" => $this->input->post('materialtypename', true),
    //         "slug" => $this->input->post('slug', true)
    //     ];
    //     return $this->save($data);
    // }

    // public function materialtypeUpdate()
    // {
    //     $data = [
    //         "id" => $this->input->post('id', true),
    //         "materialtypecode" => $this->input->post('materialtypecode', true),
    //         "materialtypename" => $this->input->post('materialtypename', true),
    //         "slug" => $this->input->post('slug', true)
    //     ];
    //     return $this->save($data);
    // }

    // public function materialtypeDelete()
    // {
    //     $data = [
    //         "id" => $this->input->post('id', true)
    //     ];
    //     return $this->delete($data);
    // }
}
