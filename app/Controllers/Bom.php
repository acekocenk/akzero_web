<?php

namespace App\Controllers;

use App\Models\bomModel;
use App\Models\categoryModel;
use App\Models\materialModel;
use App\Models\materialtypeModel;
use App\Models\colourModel;

class bom extends BaseController
{
    protected $bomModel;
    protected $categoryModel;
    protected $materialModel;
    protected $materialtypeModel;
    protected $colourModel;

    public function __construct()
    {
        $this->bomModel = new bomModel();
        $this->categoryModel = new categoryModel();
        $this->materialModel = new materialModel();
        $this->materialtypeModel = new materialtypeModel();
        $this->colourModel = new colourModel();

        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'List BOM',
            //'bom' => $this->bomModel->bomList()
        ];
        return view('masterinv/bom/index', $data);
    }

    public function loaddata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List BOM',
                //'bom' => $this->bomModel->bomList()
            ];
            $msg = [
                'view' => view('masterinv/bom/view', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function loadlistbom()
    {
        if ($this->request->isAJAX()) {
            $fetch_data = $this->bomModel->bomListajax();
            $data = array();
            $no = 1;
            foreach ($fetch_data as $row) {
                $sub_array = array();
                $sub_array[] = $no++;
                $sub_array[] = '<img src="' . base_url() . '/img/bom/' . $row->bomimg . '" alt="" class="sampul">';
                $sub_array[] = $row->bomcode;
                $sub_array[] = $row->bomname;
                $sub_array[] = $row->unit;
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
                'title' => 'Add BOM',
                'category' => $this->categoryModel->CategoryList(),
                'material' => $this->materialModel->materialList(),
                'materialtype' => $this->materialtypeModel->materialtypeList(),
                'colour' => $this->colourModel->colourList(),
                'validation' =>  \Config\Services::validation()
            ];
            $msg = [
                'create' => view('masterinv/bom/create', $data)
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
                'bomcode' => [
                    'rules' => 'required|is_unique[bom.bomcode]|max_length[13]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 13 huruf.'
                    ]
                ],
                'bomname' => [
                    'rules' => 'required|is_unique[bom.bomname]|max_length[50]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 50 huruf.'
                    ]
                ],
                'bomimg' => [
                    'rules' => 'max_size[bomimg,4096]|is_image[bomimg]|mime_in[bomimg,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran maksimal img 4MB.',
                        'is_image' => 'File terbaca bukan gambar.',
                        'mime_is' => 'tipe gambar harus jpg, jpeg, png.'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'bomcode' => validation_show_error('bomcode'),
                        'bomname' => validation_show_error('bomname'),
                        'bomimg' => validation_show_error('bomimg'),
                    ]
                ];
            } else {
                //proses gambar
                $filePicture = $this->request->getFile('bomimg');

                if ($filePicture->getError() == 4) {
                    $namaPicture = 'default.png';
                } else {
                    $namaPicture = $filePicture->getRandomName();
                    $filePicture->move('img/bom', $namaPicture);
                }

                $slug = url_title($this->request->getVar('bomname'), '-', true);

                $this->bomModel->save(
                    [
                        'bomcode' => strtoupper($this->request->getVar('bomcode')),
                        'bomname' => strtoupper($this->request->getVar('bomname')),
                        'categorycode' => $this->request->getVar('category'),
                        'materialcode' => $this->request->getVar('material'),
                        'materialtypecode' => $this->request->getVar('materialtype'),
                        'colourcode' => $this->request->getVar('colour'),
                        'unit' => strtoupper($this->request->getVar('unit')),
                        'slug' => $slug,
                        'bomimg' => $namaPicture
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('bomname') . ' added successfully'
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
                'title' => 'Edit BOM',
                'bom' => $this->bomModel->bomList($slug),
                'category' => $this->categoryModel->CategoryList(),
                'material' => $this->materialModel->materialList(),
                'materialtype' => $this->materialtypeModel->materialtypeList(),
                'colour' => $this->colourModel->colourList()
            ];
            $msg = [
                'edit' => view('masterinv/bom/edit', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $bomLama = $this->bomModel->bomList($this->request->getVar('slug'));

            if ($bomLama['bomcode'] == $this->request->getVar('bomcode')) {
                $rule_bomcode = 'required|max_length[13]';
            } else {
                $rule_bomcode = 'required|is_unique[bom.bomcode]|max_length[13]';
            }
            if ($bomLama['bomname'] == $this->request->getVar('bomname')) {
                $rule_bomname = 'required|max_length[50]';
            } else {
                $rule_bomname = 'required|is_unique[bom.bomname]|max_length[50]';
            }

            $valid = $this->validate([
                'bomcode' => [
                    'rules' => $rule_bomcode,
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 13 huruf'
                    ]
                ],
                'bomname' => [
                    'rules' => $rule_bomname,
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 50 huruf'
                    ]
                ],
                'bomimg' => [
                    'rules' => 'max_size[bomimg,4096]|is_image[bomimg]|mime_in[bomimg,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran maksimal img 4MB.',
                        'is_image' => 'File terbaca bukan gambar.',
                        'mime_is' => 'tipe gambar harus jpg, jpeg, png.'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'bomcode' => validation_show_error('bomcode'),
                        'bomname' => validation_show_error('bomname'),
                        'bomimg' => validation_show_error('bomimg'),
                    ]
                ];
            } else {

                //proses gambar
                $filePicture = $this->request->getFile('bomimg');

                if ($filePicture->getError() == 4) {
                    $namaPicture = $this->request->getVar('bomimgLama');
                } else {
                    if ($this->request->getVar('bomimgLama') != "default.png") {
                        unlink('img/bom/' . $this->request->getVar('bomimgLama'));
                    }
                    $namaPicture = $filePicture->getRandomName();
                    $filePicture->move('img/bom', $namaPicture);
                }

                $slug = url_title($this->request->getVar('bomname'), '-', true);

                $this->bomModel->save(
                    [
                        'id' => $this->request->getVar('id'),
                        'bomcode' => strtoupper($this->request->getVar('bomcode')),
                        'bomname' => strtoupper($this->request->getVar('bomname')),
                        'categorycode' => $this->request->getVar('category'),
                        'materialcode' => $this->request->getVar('material'),
                        'materialtypecode' => $this->request->getVar('materialtype'),
                        'colourcode' => $this->request->getVar('colour'),
                        'unit' => strtoupper($this->request->getVar('unit')),
                        'slug' => $slug,
                        'bomimg' => $namaPicture
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('bomname') . ' Update successfully'
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
            $id = $this->request->getVar('Bomid');
            $this->bomModel->delete($id);
            $msg = [
                'sukses' => 'delete successfully'
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }
}
