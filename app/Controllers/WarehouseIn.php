<?php

namespace App\Controllers;

// use App\Models\ProductModel;

class WarehouseIn extends BaseController
{
    protected $productModel;
    public function __construct()
    {
        // $this->productModel = new productModel();
        helper(['form']);
    }
    public function index()
    {
        // $product = $this->ProductModel->findAll();
        // helper(['form']);
        $data = [
            'title' => 'Warehouse Incoming',
            // 'product' => $this->productModel->getproduct()
        ];

        //dd($product);
        return view('inventory/warehousein/index', $data);
    }
}
