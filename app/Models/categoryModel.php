<?php

namespace App\Models;

use CodeIgniter\Model;

class categoryModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = ['categorycode', 'categoryname', 'slug'];

    public function CategoryList($slug = false)
    {
        if ($slug == false) {
            $this->orderby('categoryname');
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function CategoryListajax()
    {
        $builder = $this->db->table('category');
        $query = $builder->get();

        return $query->getResult();
    }

    // public function CategoryInsert()
    // {
    //     $data = [
    //         "categorycode" => $this->input->post('categorycode', true),
    //         "categoryname" => $this->input->post('categoryname', true),
    //         "slug" => $this->input->post('slug', true)
    //     ];
    //     return $this->save($data);
    // }

    // public function CategoryUpdate()
    // {
    //     $data = [
    //         "id" => $this->input->post('id', true),
    //         "categorycode" => $this->input->post('categorycode', true),
    //         "categoryname" => $this->input->post('categoryname', true),
    //         "slug" => $this->input->post('slug', true)
    //     ];
    //     return $this->save($data);
    // }

    // public function CategoryDelete()
    // {
    //     $data = [
    //         "id" => $this->input->post('id', true)
    //     ];
    //     return $this->delete($data);
    // }
}
