<?php

namespace App\Controllers;

use App\Models\supplierModel;
use App\Models\abiproModel;

class Supplier extends BaseController
{
    protected $supplierModel;
    protected $abiproModel;
    public function __construct()
    {
        $this->supplierModel = new supplierModel();
        $this->abiproModel = new abiproModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'List Supplier',
            'supplier' => $this->supplierModel->supplierList()
        ];
        return view('supplier/index', $data);
    }

    public function loaddata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List Supplier',
                'supplier' => $this->supplierModel->supplierList()
            ];
            $msg = [
                'view' => view('supplier/view', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }
    public function create()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Add Supplier',
                'validation' =>  \Config\Services::validation(),
                'abipro' => $this->abiproModel->hutimasList()
            ];
            $msg = [
                'create' => view('supplier/create', $data)
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
                'suppliername' => [
                    'rules' => 'required|is_unique[supplier.suppliername]',
                    'errors' => [
                        'required' => 'The Supplier field is required .',
                        'is_unique' => 'The Supplier field must contain a unique value.'
                    ]
                ],
                'telp' => [
                    'rules' => 'regex_match[/^[0-9]/]',
                    // 'errors' => [
                    //     'valid_email' => 'The Email field must contain a valid email address.'
                    // ]
                ],
                'email' => [
                    'rules' => 'valid_email',
                    'errors' => [
                        'valid_email' => 'The Email field must contain a valid email address.'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'suppliername' => validation_show_error('suppliername'),
                        'email' => validation_show_error('email'),
                        'telp' => validation_show_error('telp'),
                    ]
                ];
            } else {

                $slug = url_title($this->request->getVar('suppliername'), '-', true);
                $this->supplierModel->save(
                    [
                        'suppliername' => ucfirst($this->request->getVar('suppliername')),
                        'address' => $this->request->getVar('address'),
                        'telp' => $this->request->getVar('telp'),
                        'email' => $this->request->getVar('email'),
                        'acccode' => $this->request->getVar('acccode'),
                        'slug' => $slug
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('suppliername') . ' added successfully'
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
                'title' => 'Edit Supplier',
                'supplier' => $this->supplierModel->supplierList($slug),
                'abipro' => $this->abiproModel->hutimasList()
            ];
            $msg = [
                'edit' => view('supplier/edit', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $supplierLama = $this->supplierModel->supplierList($this->request->getVar('slug'));

            if ($supplierLama['suppliername'] == $this->request->getVar('suppliername')) {
                $rule_suppliername = 'required';
            } else {
                $rule_suppliername = 'required|is_unique[supplier.suppliername]';
            }

            $valid = $this->validate([
                'suppliername' => [
                    'rules' => $rule_suppliername,
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 4 huruf.'
                    ]
                ],
                'telp' => [
                    'rules' => 'regex_match[/^[0-9]/]',
                    // 'errors' => [
                    //     'valid_email' => 'The Email field must contain a valid email address.'
                    // ]
                ],
                'email' => [
                    'rules' => 'valid_email',
                    'errors' => [
                        'valid_email' => 'The Email field must contain a valid email address.'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'suppliername' => validation_show_error('suppliername'),
                        'email' => validation_show_error('email'),
                        'telp' => validation_show_error('telp'),
                    ]
                ];
            } else {
                $slug = url_title($this->request->getVar('suppliername'), '-', true);
                $this->supplierModel->save(
                    [
                        'id' => $this->request->getVar('id'),
                        'suppliername' => ucfirst($this->request->getVar('suppliername')),
                        'address' => $this->request->getVar('address'),
                        'telp' => $this->request->getVar('telp'),
                        'email' => $this->request->getVar('email'),
                        'acccode' => $this->request->getVar('acccode'),
                        'slug' => $slug
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('suppliername') . ' Update successfully'
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
            $id = $this->request->getVar('supplierid');
            $this->supplierModel->delete($id);
            $msg = [
                'sukses' => 'delete successfully'
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }
}
