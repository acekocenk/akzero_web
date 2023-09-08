<?php

namespace App\Controllers;

use App\Models\materialtypeModel;

class MaterialType extends BaseController
{
    protected $materialtypeModel;
    public function __construct()
    {
        $this->materialtypeModel = new materialtypeModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'List Material Type',
            // 'materialtype' => $this->materialtypeModel->materialtypeList()
        ];
        return view('masterinv/materialtype/index', $data);
    }

    public function loaddata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List Material Type',
                // 'materialtype' => $this->materialtypeModel->materialtypeList()
            ];
            $msg = [
                'view' => view('masterinv/materialtype/view', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function materialtypeloaddt()
    {
        if ($this->request->isAJAX()) {
            $fetch_data = $this->materialtypeModel->materialtypeDataTable();
            $data = array();
            $no = 1;
            foreach ($fetch_data as $row) {
                $sub_array = array();
                $sub_array[] = $no++;
                $sub_array[] = $row->materialtypecode;
                $sub_array[] = $row->materialtypename;
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
                'title' => 'Add Material Type',
                'validation' =>  \Config\Services::validation()
            ];
            $msg = [
                'create' => view('masterinv/materialtype/create', $data)
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
                'materialtypecode' => [
                    'rules' => 'required|is_unique[materialtype.materialtypecode]|max_length[4]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 4 huruf.'
                    ]
                ],
                'materialtypename' => [
                    'rules' => 'required|is_unique[materialtype.materialtypename]|max_length[50]',
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
                        'materialtypecode' => validation_show_error('materialtypecode'),
                        'materialtypename' => validation_show_error('materialtypename'),
                    ]
                ];
            } else {

                $slug = url_title($this->request->getVar('materialtypename'), '-', true);
                $this->materialtypeModel->save(
                    [
                        'materialtypecode' => strtoupper($this->request->getVar('materialtypecode')),
                        'materialtypename' => strtoupper($this->request->getVar('materialtypename')),
                        'slug' => $slug
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('materialtypename') . ' added successfully'
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
                'title' => 'Edit Material Type',
                'materialtype' => $this->materialtypeModel->materialtypeList($slug)
            ];
            $msg = [
                'edit' => view('masterinv/materialtype/edit', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $materialtypeLama = $this->materialtypeModel->materialtypeList($this->request->getVar('slug'));

            if ($materialtypeLama['materialtypecode'] == $this->request->getVar('materialtypecode')) {
                $rule_materialtypecode = 'required|max_length[4]';
            } else {
                $rule_materialtypecode = 'required|is_unique[materialtype.materialtypecode]|max_length[4]';
            }
            if ($materialtypeLama['materialtypename'] == $this->request->getVar('materialtypename')) {
                $rule_materialtypename = 'required|max_length[50]';
            } else {
                $rule_materialtypename = 'required|is_unique[materialtype.materialtypename]|max_length[50]';
            }

            $valid = $this->validate([
                'materialtypecode' => [
                    'rules' => $rule_materialtypecode,
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 4 huruf.'
                    ]
                ],
                'materialtypename' => [
                    'rules' => $rule_materialtypename,
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
                        'materialtypecode' => validation_show_error('materialtypecode'),
                        'materialtypename' => validation_show_error('materialtypename'),
                    ]
                ];
            } else {

                $slug = url_title($this->request->getVar('materialtypename'), '-', true);

                $this->materialtypeModel->save(
                    [
                        'id' => $this->request->getVar('id'),
                        'materialtypecode' => strtoupper($this->request->getVar('materialtypecode')),
                        'materialtypename' => strtoupper($this->request->getVar('materialtypename')),
                        'slug' => $slug
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('materialtypename') . ' Update successfully'
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
            $id = $this->request->getVar('materialtypeid');
            $this->materialtypeModel->delete($id);
            $msg = [
                'sukses' => 'delete successfully'
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }
}
