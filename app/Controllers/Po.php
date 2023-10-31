<?php

namespace App\Controllers;

use App\Models\poModel;
use App\Models\podetailModel;
use App\Models\itemsModel;
use App\Models\supplierModel;
use Kint\Parser\ToStringPlugin;

class po extends BaseController
{
    protected $poModel;
    protected $podetailModel;
    protected $supplierModel;
    protected $itemsModel;

    public function __construct()
    {
        $this->poModel = new poModel();
        $this->podetailModel = new podetailModel();
        $this->itemsModel = new itemsModel();
        $this->supplierModel = new supplierModel();

        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Purchase Order',

        ];
        return view('po/index', $data);
    }

    // Load Data
    public function loaddata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List Purchase Order',
            ];
            $msg = [
                'view' => view('po/view', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function loadlistpo()
    {
        if ($this->request->isAJAX()) {
            $fetch_data = $this->poModel->poListajax();
            $data = array();
            $no = 1;
            foreach ($fetch_data as $row) {
                $sub_array = array();
                $sub_array[] = $no++;
                $sub_array[] = $row->potype;
                $sub_array[] = $row->pono;
                $sub_array[] = $row->podate;
                $sub_array[] = $row->indate;
                $sub_array[] = $row->currency;
                $sub_array[] = $row->suppliername;
                $sub_array[] = $row->discount;
                $sub_array[] = $row->ppn;
                $sub_array[] = $row->grandtotal;
                $sub_array[] = $row->postatus;
                $sub_array[] = $row->fullname;
                $sub_array[] = '<a href="/po/edit/' . $row->pono . '" class="btn btn-primary btn-sm"><i class="fa-solid fa-file-pen"></i>&nbsp;Edit</a>;<button type="button" class="btn btn-danger btn-sm" onclick="' . "remove('$row->pono')" . '"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>';
                // $sub_array[] = '<button type="button" class="btn btn-primary btn-sm" onclick="' . "edit('$row->pono')" . '"><i class="fa-solid fa-file-pen"></i>&nbsp;Edit</button>&nbsp;<button type="button" class="btn btn-danger btn-sm" onclick="' . "remove('$row->pono')" . '"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>';
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

    public function loadlistpo_detail()
    {
        if ($this->request->isAJAX()) {
            $poid = $this->request->getVar('poid');
            $fetch_data = $this->podetailModel->podetailListajax($poid);
            $data = array();
            $no = 1;
            foreach ($fetch_data as $row) {
                $sub_array = array();
                $sub_array[] = $no++;
                $sub_array[] = $row->itemcode;
                $sub_array[] = $row->itemname;
                $sub_array[] = $row->qty;
                $sub_array[] = $row->unit;
                $sub_array[] = $row->qty2;
                $sub_array[] = $row->unit2;
                $sub_array[] = $row->qtyprice;
                $sub_array[] = $row->qtypriceunit;
                $sub_array[] = $row->price;
                $sub_array[] = $row->total;
                $sub_array[] = '<button type="button" class="btn btn-primary btn-sm" onclick="' . "podetailEdit('$row->id')" . '"><i class="fa-solid fa-file-pen"></i>&nbsp;Edit</button>&nbsp;<button type="button" class="btn btn-danger btn-sm" onclick="' . "podetailRemove('$row->id')" . '"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>';
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
    // End Load Data
    // Get Data
    public function getItems()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'data' => $this->itemsModel->itemsList(),
            ];

            echo json_encode($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Not Found');
        }
    }

    public function getPO()
    {
        if ($this->request->isAJAX()) {
            $pono = $this->request->getVar('pono');
            $data = $this->poModel->getPO($pono);
            if (empty($data)) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('product ' . $pono . ' Not Found');
            }
            echo json_encode($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Not Found');
        }
    }
    public function getPODetail()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = $this->podetailModel->getPoDetail($id);
            if (empty($data)) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('product ' . $id . ' Not Found');
            }
            echo json_encode($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Not Found');
        }
    }

    public function getPONO()
    {
        if ($this->request->isAJAX()) {
            $ab = $this->request->getVar('potype');
            if (!empty($ab)) {
                $msg = [
                    'pono' => $this->poModel->getPONO($ab),
                ];
            } else {
                $msg = [
                    'pono' => "",
                ];
            }
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Not Found');
        }
    }
    public function getPOSUM()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            if (!empty($id)) {
                $msg = [
                    'gt' => $this->podetailModel->getPoDetailSUM($id),
                ];
            } else {
                $msg = [
                    'gt' => "0",
                ];
            }
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Not Found');
        }
    }
    // End Get Data

    // CRUD PO
    public function createPo()
    {
        $data = [
            'title' => 'Purchase Order Create',
            'item' => $this->itemsModel->itemsList(),
            'supplier' => $this->supplierModel->supplierList(),
        ];
        return view('po/create', $data);
    }

    public function editPo($pono)
    {
        $data = [
            'title' => 'Purchase Order Create',
            'item' => $this->itemsModel->itemsList(),
            'supplier' => $this->supplierModel->supplierList(),
            'po' => $this->poModel->poList($pono)
        ];
        if (empty($data['po'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Purchase Order ' . $pono . ' Not Found');
        }
        return view('po/edit', $data);
    }

    public function savePo()
    {
        if ($this->request->isAJAX()) {
            $valid = $this->validate([
                'potype' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],
                'pono' => [
                    'rules' => 'required|is_unique[po.pono]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} sudah terpakai.'
                    ]
                ], 'supplierid' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'potype' => validation_show_error('potype'),
                        'supplierid' => validation_show_error('supplierid'),
                        'pono' => validation_show_error('pono')
                    ]
                ];
            } else {
                $postatus = "Draft";
                $userid = user()->id;
                $this->poModel->save(
                    [
                        'potype' => $this->request->getVar('potype'),
                        'pono' => $this->request->getVar('pono'),
                        'podate' => $this->request->getVar('podate'),
                        'indate' => $this->request->getVar('indate'),
                        'currency' => $this->request->getVar('currency'),
                        'supplierid' => $this->request->getVar('supplierid'),
                        'usersid' => $userid,
                        'discount' => $this->request->getVar('discount'),
                        'ppn' => $this->request->getVar('ppn'),
                        'terbilang' => '',
                        'postatus' => $postatus
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('pono') . ' added successfully'
                ];
            }
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function updatePo()
    {
        if ($this->request->isAJAX()) {
            $valid = $this->validate([
                'potype' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],
                'pono' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ], 'supplierid' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'potype' => validation_show_error('potype'),
                        'supplierid' => validation_show_error('supplierid'),
                        'pono' => validation_show_error('pono')
                    ]
                ];
            } else {
                $postatus = "New PO";
                $userid = user()->id;
                $this->poModel->save(
                    [
                        'id' => $this->request->getVar('poid'),
                        'potype' => $this->request->getVar('potype'),
                        'pono' => $this->request->getVar('pono'),
                        'podate' => $this->request->getVar('podate'),
                        'indate' => $this->request->getVar('indate'),
                        'currency' => $this->request->getVar('currency'),
                        'supplierid' => $this->request->getVar('supplierid'),
                        'usersid' => $userid,
                        'discount' => $this->request->getVar('discount'),
                        'ppn' => $this->request->getVar('ppn'),
                        'terbilang' => '',
                        'postatus' => $postatus
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('pono') . ' process successfully'
                ];
            }
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }
    // End CRUD PO

    // CRUD PO Detail
    public function savePoDetail()
    {
        $this->podetailModel->save(
            [
                'poid' => $this->request->getVar('addpoid'),
                'itemcode' => $this->request->getVar('additemcode'),
                'itemname' => $this->request->getVar('additemname'),
                'qty' => $this->request->getVar('addqty1'),
                'unit' => $this->request->getVar('addunit1'),
                'qty2' => $this->request->getVar('addqty2'),
                'unit2' => $this->request->getVar('addunit2'),
                'qtyprice' => $this->request->getVar('addqtyprice'),
                'qtypriceunit' => $this->request->getVar('addpriceunit'),
                'price' => $this->request->getVar('addprice'),
                'total' => $this->request->getVar('addtotal'),
            ]
        );
        $msg = [
            'sukses' => $this->request->getVar('addpoid') . ' added successfully'
        ];
        echo json_encode($msg);
    }

    public function deletePoDetail()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $this->podetailModel->delete($id);
            $msg = [
                'sukses' => 'delete successfully'
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }
    // End CRUD PO Detail
}
