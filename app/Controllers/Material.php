<?php

namespace App\Controllers;

use App\Models\MaterialModel;

class Material extends BaseController
{
    protected $materialModel;
    public function __construct()
    {
        $this->materialModel = new materialModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'List Material',
            // 'material' => $this->materialModel->materialList()
        ];
        return view('masterinv/material/index', $data);
    }

    public function loaddata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List Material',
                // 'material' => $this->materialModel->materialList()
            ];
            $msg = [
                'view' => view('masterinv/material/view', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function materialloaddt()
    {
        if ($this->request->isAJAX()) {
            $fetch_data = $this->materialModel->materialDataTable();
            $data = array();
            $no = 1;
            foreach ($fetch_data as $row) {
                $sub_array = array();
                $sub_array[] = $no++;
                $sub_array[] = $row->materialcode;
                $sub_array[] = $row->materialname;
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
                'title' => 'Add Material',
                'validation' =>  \Config\Services::validation()
            ];
            $msg = [
                'create' => view('masterinv/material/create', $data)
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
                'materialcode' => [
                    'rules' => 'required|is_unique[material.materialcode]|max_length[3]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 3 huruf.'
                    ]
                ],
                'materialname' => [
                    'rules' => 'required|is_unique[material.materialname]|max_length[50]',
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
                        'materialcode' => validation_show_error('materialcode'),
                        'materialname' => validation_show_error('materialname'),
                    ]
                ];
            } else {

                $slug = url_title($this->request->getVar('materialname'), '-', true);
                $this->materialModel->save(
                    [
                        'materialcode' => strtoupper($this->request->getVar('materialcode')),
                        'materialname' => strtoupper($this->request->getVar('materialname')),
                        'slug' => $slug
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('materialname') . ' added successfully'
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
                'title' => 'Edit material',
                'material' => $this->materialModel->materialList($slug)
            ];
            $msg = [
                'edit' => view('masterinv/material/edit', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $materialLama = $this->materialModel->materialList($this->request->getVar('slug'));

            if ($materialLama['materialcode'] == $this->request->getVar('materialcode')) {
                $rule_materialcode = 'required|max_length[3]';
            } else {
                $rule_materialcode = 'required|is_unique[material.materialcode]|max_length[3]';
            }
            if ($materialLama['materialname'] == $this->request->getVar('materialname')) {
                $rule_materialname = 'required|max_length[50]';
            } else {
                $rule_materialname = 'required|is_unique[material.materialname]|max_length[50]';
            }

            $valid = $this->validate([
                'materialcode' => [
                    'rules' => $rule_materialcode,
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 3 huruf.'
                    ]
                ],
                'materialname' => [
                    'rules' => $rule_materialname,
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
                        'materialcode' => validation_show_error('materialcode'),
                        'materialname' => validation_show_error('materialname'),
                    ]
                ];
            } else {

                $slug = url_title($this->request->getVar('materialname'), '-', true);

                $this->materialModel->save(
                    [
                        'id' => $this->request->getVar('id'),
                        'materialcode' => strtoupper($this->request->getVar('materialcode')),
                        'materialname' => strtoupper($this->request->getVar('materialname')),
                        'slug' => $slug
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('materialname') . ' Update successfully'
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
            $id = $this->request->getVar('materialid');
            $this->materialModel->delete($id);
            $msg = [
                'sukses' => 'delete successfully'
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }
}
