<?php

namespace App\Controllers;

use App\Models\colourModel;

class colour extends BaseController
{
    protected $colourModel;
    protected $valid;
    public function __construct()
    {
        $this->colourModel = new colourModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'List colour',
            // 'colour' => $this->colourModel->colourList()
        ];
        return view('masterinv/colour/index', $data);
    }

    public function loaddata()
    {
        if ($this->request->isAJAX()) {
            session()->remove('formaksi');
            $data = [
                'title' => 'List Colour',
                // 'colour' => $this->colourModel->colourList()
            ];
            $msg = [
                'view' => view('masterinv/colour/view', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function colourloaddt()
    {
        if ($this->request->isAJAX()) {
            $fetch_data = $this->colourModel->colourDataTable();
            $data = array();
            $no = 1;
            foreach ($fetch_data as $row) {
                $sub_array = array();
                $sub_array[] = $no++;
                $sub_array[] = $row->colourcode;
                $sub_array[] = $row->colourname;
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

    public function Valid()
    {
        if (session()->get('formaksi') == 'add') {
            $this->valid = $this->validate([
                'colourcode' => [
                    'rules' => 'required|is_unique[colour.colourcode]|max_length[3]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 3 huruf.'
                    ]
                ],
                'colourname' => [
                    'rules' => 'required|is_unique[colour.colourname]|max_length[50]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 50 huruf.'
                    ]
                ],
            ]);
        } else {
            $colourLama = $this->colourModel->colourList($this->request->getVar('slug'));

            if ($colourLama['colourcode'] == $this->request->getVar('colourcode')) {
                $rule_colourcode = 'required|max_length[3]';
            } else {
                $rule_colourcode = 'required|is_unique[colour.colourcode]|max_length[3]';
            }
            if ($colourLama['colourname'] == $this->request->getVar('colourname')) {
                $rule_colourname = 'required|max_length[50]';
            } else {
                $rule_colourname = 'required|is_unique[colour.colourname]|max_length[50]';
            }

            $this->valid = $this->validate([
                'colourcode' => [
                    'rules' => $rule_colourcode,
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 3 huruf.'
                    ]
                ],
                'colourname' => [
                    'rules' => $rule_colourname,
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 50 huruf.'
                    ]
                ],
            ]);
        }
        return $this->valid;
    }
    public function create()
    {
        if ($this->request->isAJAX()) {
            session()->set([
                'formaksi' => 'add'
            ]);
            $data = [
                'title' => 'Add Colour',
                'validation' =>  \Config\Services::validation()
            ];
            $msg = [
                'create' => view('masterinv/colour/create', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }
    public function save()
    {
        if ($this->request->isAJAX()) {
            $this->Valid();
            if (!$this->valid) {
                $msg = [
                    'error' => [
                        'colourcode' => validation_show_error('colourcode'),
                        'colourname' => validation_show_error('colourname'),
                    ]
                ];
            } else {
                $slug = url_title($this->request->getVar('colourname'), '-', true);
                $this->colourModel->save(
                    [
                        'colourcode' => strtoupper($this->request->getVar('colourcode')),
                        'colourname' => strtoupper($this->request->getVar('colourname')),
                        'slug' => $slug
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('colourname') . ' added successfully'
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
            session()->set([
                'formaksi' => 'edit'
            ]);
            $slug = $this->request->getVar('slug');
            $data = [
                'title' => 'Edit colour',
                'colour' => $this->colourModel->colourList($slug)
            ];
            $msg = [
                'edit' => view('masterinv/colour/edit', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $this->Valid();
            if (!$this->valid) {
                $msg = [
                    'error' => [
                        'colourcode' => validation_show_error('colourcode'),
                        'colourname' => validation_show_error('colourname'),
                    ]
                ];
            } else {
                $slug = url_title($this->request->getVar('colourname'), '-', true);
                $this->colourModel->save(
                    [
                        'id' => $this->request->getVar('id'),
                        'colourcode' => strtoupper($this->request->getVar('colourcode')),
                        'colourname' => strtoupper($this->request->getVar('colourname')),
                        'slug' => $slug
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('colourname') . ' Update successfully'
                ];
            }
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }
    public function delete()
    {
        // kasd
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $this->colourModel->delete($id);
            $msg = [
                'sukses' => 'delete successfully'
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }
}
