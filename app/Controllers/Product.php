<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Product extends BaseController
{
    protected $productModel;
    public function __construct()
    {
        $this->productModel = new productModel();
        helper(['form']);
    }
    public function index()
    {
        // $product = $this->ProductModel->findAll();
        // helper(['form']);
        $data = [
            'title' => 'List Product',
            'product' => $this->productModel->getproduct()
        ];

        //dd($product);
        return view('masterinv/product/productview', $data);
    }

    public function viewProduct()
    {
        //if ($this->request->isAJAX()) {
        $data = $this->productModel->getProduct();
        echo json_encode($data);
        // } else {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        // }
    }

    public function detail($slug)
    {
        // $product = $this->productModel->where(['slug' => $slug])->first()
        // helper(['form']);
        $data = [
            'title' => 'Detail product',
            'product' => $this->productModel->getProduct($slug)
        ];

        if (empty($data['product'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('product ' . $slug . ' Not Found');
        }
        return view('masterinv/product/productdetail', $data);
        // dd($product);
    }

    public function create()
    {
        // helper(['form']);
        $data = [
            'title' => 'Form Add Product',
            'validation' =>  \Config\Services::validation()
        ];
        return view('masterinv/product/productcreate', $data);
    }

    public function save()
    {
        // validasi input
        // helper(['form']);
        if (!$this->validate(
            [
                'productid' => [
                    'rules' => 'required|is_unique[product.product_id]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.'
                    ]
                ],
                'productname' => [
                    'rules' => 'required|is_unique[product.product_name]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.'
                    ]
                ],
                'productimg' => [
                    'rules' => 'max_size[productimg,4096]|is_image[productimg]|mime_in[productimg,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran maksimal img 4MB.',
                        'is_image' => 'File terbaca bukan gambar.',
                        'mime_is' => 'tipe gambar harus jpg, jpeg, png.'
                    ]
                ]
            ]
        )) {
            //session()->setFlashdata('error', $this->validator->listErrors());
            // $validation =  \Config\Services::validation();
            return redirect()->to('/product/create')->withInput();
            // return redirect()->back()->withInput();
        }

        //proses gambar
        $filePicture = $this->request->getFile('productimg');

        if ($filePicture->getError() == 4) {
            $namaPicture = 'default.png';
        } else {
            $namaPicture = $filePicture->getRandomName();
            $filePicture->move('img/product', $namaPicture);
        }

        $slug = url_title($this->request->getVar('productname'), '-', true);

        $this->productModel->save(
            [
                'product_id' => $this->request->getVar('productid'),
                'product_name' => $this->request->getVar('productname'),
                'slug' => $slug,
                'product_img' => $namaPicture
            ]
        );

        session()->setFlashdata('pesan', 'product succes');

        return redirect()->to('/product');
    }

    public function delete($id)
    {

        $product = $this->productModel->find($id);
        if ($product['product_img'] != "default.png") {
            unlink('img/product/' . $product['product_img']);
        }
        // helper(['form']);
        $this->productModel->delete($id);

        session()->setFlashdata('pesan', 'delete product succes');
        return redirect()->to('/product');
    }

    public function edit($slug)
    {
        // helper(['form']);
        // $product = $this->productModel->getProduct($id);
        $data = [
            'title' => 'Form Edit Product',
            'product' => $this->productModel->getProduct($slug),
            'validation' =>  \Config\Services::validation()
        ];
        return view('masterinv/product/productedit', $data);
        // dd($product);
    }

    public function update($id)
    {
        // helper(['form']);

        //check
        $productLama = $this->productModel->getProduct($this->request->getVar('slug'));

        if ($productLama['product_id'] == $this->request->getVar('productid')) {
            $rule_productid = 'required';
        } else {
            $rule_productid = 'required|is_unique[product.product_id]';
        }
        if ($productLama['product_name'] == $this->request->getVar('productname')) {
            $rule_productname = 'required';
        } else {
            $rule_productname = 'required|is_unique[product.product_id]';
        }


        if (!$this->validate([
            'productid' => [
                'rules' => $rule_productid,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terpakai'
                ]
            ],
            'productname' => [
                'rules' => $rule_productname,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terpakai'
                ]
            ],
            'productimg' => [
                'rules' => 'max_size[productimg,4096]|is_image[productimg]|mime_in[productimg,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran maksimal img 4MB.',
                    'is_image' => 'File terbaca bukan gambar.',
                    'mime_is' => 'tipe gambar harus jpg,jpeg,png.'
                ]
            ]
        ])) {
            return redirect()->to('/product/edit/' . $this->request->getVar('slug'))->withInput();
        }

        //proses gambar
        $filePicture = $this->request->getFile('productimg');

        if ($filePicture->getError() == 4) {
            $namaPicture = $this->request->getVar('productimgLama');
        } else {
            if ($this->request->getVar('productimgLama') != "default.png") {
                unlink('img/product/' . $this->request->getVar('productimgLama'));
            }
            $namaPicture = $filePicture->getRandomName();
            $filePicture->move('img/product', $namaPicture);
        }

        $slug = url_title($this->request->getVar('productname'), '-', true);

        $this->productModel->save(
            [
                'id' => $id,
                'product_id' => $this->request->getVar('productid'),
                'product_name' => $this->request->getVar('productname'),
                'slug' => $slug,
                'product_img' => $namaPicture
            ]
        );

        session()->setFlashdata('pesan', 'product succes');

        return redirect()->to('/product');
    }
}
