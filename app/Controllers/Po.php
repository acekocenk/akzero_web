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
            // 'po' => $this->poModel->poListajax()
            // 'item' => $this->itemsModel->itemsListajax()

        ];
        return view('po/index', $data);
    }

    public function loaddata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List Purchase Order',
                // 'po' => $this->poModel->poListajax()
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
                $sub_array[] = '<button type="button" class="btn btn-primary btn-sm" onclick="' . "edit('$row->poid')" . '"><i class="fa-solid fa-file-pen"></i>&nbsp;Edit</button>&nbsp;<button type="button" class="btn btn-danger btn-sm" onclick="' . "remove('$row->poid')" . '"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>';
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
            $pono = $this->request->getVar('pono');
            $fetch_data = $this->podetailModel->podetailList($pono);
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
                $sub_array[] = $row->price;
                $sub_array[] = $row->total;
                $sub_array[] = '<button type="button" class="btn btn-primary btn-sm" onclick="' . "edit('$row->id')" . '"><i class="fa-solid fa-file-pen"></i>&nbsp;Edit</button>&nbsp;<button type="button" class="btn btn-danger btn-sm" onclick="' . "remove('$row->id')" . '"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>';
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

    public function getPONO()
    {
        if ($this->request->isAJAX()) {
            $ab = $this->request->getVar('potype');
            if ($ab <> "") {
                $msg = [
                    'ab' => $this->request->getVar('potype'),
                    'pono' => $this->poModel->getPONO($this->request->getVar('potype')),
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

    public function create()
    {
        $data = [
            'title' => 'Purchase Order Create',
            'item' => $this->itemsModel->itemsList(),
            'supplier' => $this->supplierModel->supplierList(),
        ];
        return view('po/create', $data);
    }

    public function save()
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
                ],
                'supplierid' => [
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
                        'pono' => validation_show_error('pono'),
                        'supplierid' => validation_show_error('supplierid')
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
}
