<?php

namespace App\Models;

use CodeIgniter\Model;

class colourModel extends Model
{
    protected $table = 'colour';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = ['colourcode', 'colourname', 'slug'];

    public function colourList($slug = false)
    {
        if ($slug == false) {
            $this->orderby('colourname');
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }

    public function colourDataTable()
    {
        $builder = $this->db->table('colour');
        $query = $builder->get();

        return $query->getResult();
    }
    // public function colourInsert()
    // {
    //     $slug = url_title($this->request->getVar('colourname'), '-', true);
    //     $data = [
    //         "colourcode" => $this->input->post('colourcode'),
    //         "colourname" => $this->input->post('colourname'),
    //         "slug" => $slug
    //     ];
    //     return $this->save($data);
    // }

    // public function colourUpdate()
    // {
    //     $slug = url_title($this->input->post('colourname'), '-', true);
    //     $data =  [
    //         'id' => $this->input->post('id', true),
    //         'colourcode' => strtoupper($this->input->post('colourcode', true)),
    //         'colourname' => strtoupper($this->input->post('colourname', true)),
    //         'slug' => $slug
    //     ];
    //     return $this->save($data);
    // }

    // public function colourDelete()
    // {
    //     $data = [
    //         "id" => $this->input->post('colourid', true)
    //     ];
    //     return $this->delete($data);
    // }
}
