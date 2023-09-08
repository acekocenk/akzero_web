<?php

namespace App\Models;

use CodeIgniter\Model;

class productModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = ['product_id', 'product_name', 'slug', 'product_img'];

    public function getProduct($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }
}
