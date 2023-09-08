<?php

namespace App\Controllers;

use App\Models\categoryModel;

class Category extends BaseController
{
    protected $categoryModel;
    public function __construct()
    {
        $this->categoryModel = new categoryModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'List Category',
            // 'category' => $this->categoryModel->CategoryList()
        ];
        return view('masterinv/category/index', $data);
    }

    public function loaddata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List Category',
                // 'category' => $this->categoryModel->CategoryList()
            ];
            $msg = [
                'view' => view('masterinv/category/view', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function ajaxloadcategory()
    {
        if ($this->request->isAJAX()) {
            $fetch_data = $this->categoryModel->CategoryListajax();
            $data = array();
            $no = 1;
            foreach ($fetch_data as $row) {
                $sub_array = array();
                $sub_array[] = $no++;
                $sub_array[] = $row->categorycode;
                $sub_array[] = $row->categoryname;
                $sub_array[] = '<button type="button" class="btn btn-primary btn-sm" onclick="' . "edit('$row->slug')" . '"><i class="fa-solid fa-file-pen"></i>&nbsp;Edit</button>&nbsp;<button type="button" class="btn btn-danger btn-sm" onclick="' . "remove('$row->id')" . '"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>';
                $data[] = $sub_array;
            }
            $output = array(
                'data' => $data,
                'sukses' => 'successfully'
            );
            echo json_encode($output);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function create()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Add Category',
                'validation' =>  \Config\Services::validation()
            ];
            $msg = [
                'create' => view('masterinv/category/create', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $valid = $this->validate([
                'categorycode' => [
                    'rules' => 'required|is_unique[category.categorycode]|max_length[3]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 3 huruf.'
                    ]
                ],
                'categoryname' => [
                    'rules' => 'required|is_unique[category.categoryname]|max_length[50]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 50 huruf.'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'categorycode' => validation_show_error('categorycode'),
                        'categoryname' => validation_show_error('categoryname'),
                    ]
                ];
            } else {

                $slug = url_title($this->request->getVar('categoryname'), '-', true);
                $this->categoryModel->save(
                    [
                        'categorycode' => strtoupper($this->request->getVar('categorycode')),
                        'categoryname' => strtoupper($this->request->getVar('categoryname')),
                        'slug' => $slug
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('categoryname') . ' added successfully'
                ];
            }
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $slug = $this->request->getVar('slug');
            $data = [
                'title' => 'Edit Category',
                'category' => $this->categoryModel->CategoryList($slug)
            ];
            $msg = [
                'edit' => view('masterinv/category/edit', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $categoryLama = $this->categoryModel->CategoryList($this->request->getVar('slug'));

            if ($categoryLama['categorycode'] == $this->request->getVar('categorycode')) {
                $rule_categorycode = 'required|max_length[3]';
            } else {
                $rule_categorycode = 'required|is_unique[category.categorycode]|max_length[3]';
            }
            if ($categoryLama['categoryname'] == $this->request->getVar('categoryname')) {
                $rule_categoryname = 'required|max_length[50]';
            } else {
                $rule_categoryname = 'required|is_unique[category.categoryname]|max_length[50]';
            }

            $valid = $this->validate([
                'categorycode' => [
                    'rules' => $rule_categorycode,
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 3 huruf'
                    ]
                ],
                'categoryname' => [
                    'rules' => $rule_categoryname,
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 50 huruf'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'categorycode' => validation_show_error('categorycode'),
                        'categoryname' => validation_show_error('categoryname'),
                    ]
                ];
            } else {

                $slug = url_title($this->request->getVar('categoryname'), '-', true);

                $this->categoryModel->save(
                    [
                        'id' => $this->request->getVar('id'),
                        'categorycode' => strtoupper($this->request->getVar('categorycode')),
                        'categoryname' => strtoupper($this->request->getVar('categoryname')),
                        'slug' => $slug
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('categoryname') . ' Update successfully'
                ];
            }
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }
    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('categoryid');
            $this->categoryModel->delete($id);
            $msg = [
                'sukses' => 'delete successfully'
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }
}
