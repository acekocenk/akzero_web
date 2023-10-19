<?php

namespace App\Controllers;

use App\Models\poModel;
use App\Models\itemsModel;
use App\Models\supplierModel;

class po extends BaseController
{
    protected $poModel;
    protected $supplierModel;
    protected $itemsModel;

    public function __construct()
    {
        $this->poModel = new poModel();
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
                $sub_array[] = '<button type="button" class="btn btn-primary btn-sm" onclick="' . "edit('$row->pono')" . '"><i class="fa-solid fa-file-pen"></i>&nbsp;Edit</button>&nbsp;<button type="button" class="btn btn-danger btn-sm" onclick="' . "remove('$row->pono')" . '"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>';
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
}
