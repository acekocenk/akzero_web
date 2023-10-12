<?php

namespace App\Controllers;

use App\Models\itemsModel;
use App\Models\categoryModel;
use App\Models\materialModel;
use App\Models\materialtypeModel;
use App\Models\colourModel;

class items extends BaseController
{
    protected $itemsModel;
    protected $categoryModel;
    protected $materialModel;
    protected $materialtypeModel;
    protected $colourModel;

    public function __construct()
    {
        $this->itemsModel = new itemsModel();
        $this->categoryModel = new categoryModel();
        $this->materialModel = new materialModel();
        $this->materialtypeModel = new materialtypeModel();
        $this->colourModel = new colourModel();

        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'List items',
            //'items' => $this->itemsModel->itemsList()
        ];
        return view('masterinv/items/index', $data);
    }

    public function loaddata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List Items',
                //'items' => $this->itemsModel->itemsList()
            ];
            $msg = [
                'view' => view('masterinv/items/view', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function loadlistitems()
    {
        if ($this->request->isAJAX()) {
            $fetch_data = $this->itemsModel->itemsListajax();
            $data = array();
            $no = 1;
            foreach ($fetch_data as $row) {
                $sub_array = array();
                $sub_array[] = $no++;
                $sub_array[] = '<img src="' . base_url() . '/img/items/' . $row->itemimg . '" alt="" class="sampul">';
                $sub_array[] = $row->itemcode;
                $sub_array[] = $row->itemname;
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
                'title' => 'Add items',
                'category' => $this->categoryModel->CategoryList(),
                'material' => $this->materialModel->materialList(),
                'materialtype' => $this->materialtypeModel->materialtypeList(),
                'colour' => $this->colourModel->colourList(),
                'validation' =>  \Config\Services::validation()
            ];
            $msg = [
                'create' => view('masterinv/items/create', $data)
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
                'itemcode' => [
                    'rules' => 'required|is_unique[items.itemcode]|max_length[22]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 22 huruf.'
                    ]
                ],
                'itemname' => [
                    'rules' => 'required|is_unique[items.itemname]|max_length[50]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 50 huruf.'
                    ]
                ],
                'size' => [
                    'rules' => 'required|max_length[7]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_length' => '{field} maksimal 7 huruf.'
                    ]
                ],
                'itemimg' => [
                    'rules' => 'max_size[itemimg,4096]|is_image[itemimg]|mime_in[itemimg,image/jpg,image/jpeg,image/png]',
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
                        'itemcode' => validation_show_error('itemcode'),
                        'itemname' => validation_show_error('itemname'),
                        'itemsize' => validation_show_error('itemsize'),
                        'itemimg' => validation_show_error('itemimg'),
                    ]
                ];
            } else {
                //proses gambar
                $filePicture = $this->request->getFile('itemimg');

                if ($filePicture->getError() == 4) {
                    $namaPicture = 'default.png';
                } else {
                    $namaPicture = $filePicture->getRandomName();
                    $filePicture->move('img/items', $namaPicture);
                }

                $slug = url_title($this->request->getVar('itemname'), '-', true);

                $this->itemsModel->save(
                    [
                        'itemcode' => strtoupper($this->request->getVar('itemcode')),
                        'itemname' => strtoupper($this->request->getVar('itemname')),
                        'categorycode' => $this->request->getVar('category'),
                        'materialcode' => $this->request->getVar('material'),
                        'materialtypecode' => $this->request->getVar('materialtype'),
                        'colourcode' => $this->request->getVar('colour'),
                        'size' => $this->request->getVar('itemsize'),
                        'sizeunit' => $this->request->getVar('unitsize'),
                        'unit' => strtoupper($this->request->getVar('unit')),
                        'slug' => $slug,
                        'itemimg' => $namaPicture
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('itemname') . ' added successfully'
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
                'title' => 'Edit items',
                'items' => $this->itemsModel->itemsList($slug),
                'category' => $this->categoryModel->CategoryList(),
                'material' => $this->materialModel->materialList(),
                'materialtype' => $this->materialtypeModel->materialtypeList(),
                'colour' => $this->colourModel->colourList()
            ];
            $msg = [
                'edit' => view('masterinv/items/edit', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $itemsLama = $this->itemsModel->itemsList($this->request->getVar('slug'));

            if ($itemsLama['itemcode'] == $this->request->getVar('itemcode')) {
                $rule_itemcode = 'required|max_length[13]';
            } else {
                $rule_itemcode = 'required|is_unique[items.itemcode]|max_length[13]';
            }
            if ($itemsLama['itemname'] == $this->request->getVar('itemname')) {
                $rule_itemname = 'required|max_length[50]';
            } else {
                $rule_itemname = 'required|is_unique[items.itemname]|max_length[50]';
            }

            $valid = $this->validate([
                'itemcode' => [
                    'rules' => $rule_itemcode,
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 13 huruf'
                    ]
                ],
                'itemname' => [
                    'rules' => $rule_itemname,
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.',
                        'max_length' => '{field} maksimal 50 huruf'
                    ]
                ],
                'itemimg' => [
                    'rules' => 'max_size[itemimg,4096]|is_image[itemimg]|mime_in[itemimg,image/jpg,image/jpeg,image/png]',
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
                        'itemcode' => validation_show_error('itemcode'),
                        'itemname' => validation_show_error('itemname'),
                        'itemimg' => validation_show_error('itemimg'),
                    ]
                ];
            } else {

                //proses gambar
                $filePicture = $this->request->getFile('itemimg');

                if ($filePicture->getError() == 4) {
                    $namaPicture = $this->request->getVar('itemimgLama');
                } else {
                    if ($this->request->getVar('itemimgLama') != "default.png") {
                        unlink('img/items/' . $this->request->getVar('itemimgLama'));
                    }
                    $namaPicture = $filePicture->getRandomName();
                    $filePicture->move('img/items', $namaPicture);
                }

                $slug = url_title($this->request->getVar('itemname'), '-', true);

                $this->itemsModel->save(
                    [
                        'id' => $this->request->getVar('id'),
                        'itemcode' => strtoupper($this->request->getVar('itemcode')),
                        'itemname' => strtoupper($this->request->getVar('itemname')),
                        'categorycode' => $this->request->getVar('category'),
                        'materialcode' => $this->request->getVar('material'),
                        'materialtypecode' => $this->request->getVar('materialtype'),
                        'colourcode' => $this->request->getVar('colour'),
                        'size' => $this->request->getVar('size'),
                        'sizeunit' => $this->request->getVar('sizeunit'),
                        'unit' => strtoupper($this->request->getVar('unit')),
                        'slug' => $slug,
                        'itemimg' => $namaPicture
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('itemname') . ' Update successfully'
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
            $id = $this->request->getVar('itemsid');
            $this->itemsModel->delete($id);
            $msg = [
                'sukses' => 'delete successfully'
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }
}
