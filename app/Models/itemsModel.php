<?php

namespace App\Models;

use CodeIgniter\Model;

class itemsModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = ['itemcode', 'itemname', 'categorycode', 'materialcode', 'materialtypecode', 'colourcode', 'size', 'sizeunit', 'unit', 'slug', 'itemimg'];

    public function itemsList($slug = false)
    {
        if ($slug == false) {
            $this->orderby('itemname');
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function itemsListajax()
    {
        $builder = $this->db->table('items');
        $query = $builder->get();

        return $query->getResult();
    }

    // public function itemsInsert()
    // {
    //     $data = [
    //         "itemcode" => $this->input->post('itemcode', true),
    //         "itemname" => $this->input->post('itemname', true),
    //         "slug" => $this->input->post('slug', true)
    //     ];
    //     return $this->save($data);
    // }

    // public function itemsUpdate()
    // {
    //     $data = [
    //         "id" => $this->input->post('id', true),
    //         "itemcode" => $this->input->post('itemcode', true),
    //         "itemname" => $this->input->post('itemname', true),
    //         "slug" => $this->input->post('slug', true)
    //     ];
    //     return $this->save($data);
    // }

    // public function itemsDelete()
    // {
    //     $data = [
    //         "id" => $this->input->post('id', true)
    //     ];
    //     return $this->delete($data);
    // }
}
