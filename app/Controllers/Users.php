<?php

namespace App\Controllers;

// use App\Models\authModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Entities\User;

class Users extends BaseController
{
    protected $authModel, $userModel,  $GroupModel, $auth, $config;

    public function __construct()
    {
        // $this->authModel = new authModel();
        $this->userModel = new UserModel();
        $this->GroupModel = new GroupModel();
        // $this->abiproModel = new abiproModel();
        $this->config = config('Auth');
        $this->auth = service('authentication');
        helper(['form']);
    }

    public function index()
    {
        $db = \Config\Database::connect();

        $data = [
            'title' => 'List user',
            'user' => $this->userModel->getUserGroup()
        ];
        return view('user/index', $data);
    }

    public function loaddata()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title' => 'List user',
                'user' =>  $this->userModel->getUserGroup()
            ];
            $msg = [
                'view' => view('user/view', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function loadlistuser()
    {
        if ($this->request->isAJAX()) {
            $fetch_data = $this->userModel->getUserGroup();
            $data = array();
            $no = 1;
            foreach ($fetch_data as $row) {
                $sub_array = array();
                $sub_array[] = $no++;
                $sub_array[] = '<img src="' . base_url() . '/img/users/' . $row->userimg . '" alt="" class="sampul">';
                $sub_array[] = $row->fullname;
                $sub_array[] = $row->username;
                $sub_array[] = $row->email;
                $sub_array[] = $row->name;
                $sub_array[] = '<button type="button" class="btn btn-primary btn-sm" onclick="' . "edit('$row->userid')" . '"><i class="fa-solid fa-file-pen"></i>&nbsp;Edit</button>&nbsp;<button type="button" class="btn btn-danger btn-sm" onclick="' . "remove('$row->userid')" . '"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>';
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

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $userid = $this->request->getVar('userid');
            $data = [
                'title' => 'Edit User',
                'user' =>  $this->userModel->getUserGroup($userid),
                'groups' => $this->GroupModel->GroupList(),
                // 'abipro' => $this->abiproModel->hutimasList()
            ];
            $msg = [
                'edit' => view('user/edit', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            // $valid = $this->validate([
            //     'userimg' => [
            //         'rules' => 'max_size[userimg,4096]|is_image[userimg]|mime_in[userimg,image/jpg,image/jpeg,image/png,image/svg]',
            //         'errors' => [
            //             'max_size' => 'Ukuran maksimal img 4MB.',
            //             'is_image' => 'File terbaca bukan gambar.',
            //             'mime_is' => 'tipe gambar harus jpg, jpeg, png, svg.'
            //         ]
            //     ]
            // ]);
            // if (!$valid) {
            //     $msg = [
            //         'error' => [
            //             'userimg' => validation_show_error('userimg'),
            //         ]
            //     ];
            // } else {
            $groupid = $this->request->getVar('group');
            $groupidold = $this->request->getVar('groupold');
            $userid = $this->request->getVar('userid');

            $filePicture = $this->request->getFile('userimg');

            if ($filePicture->getError() == 4) {
                $namaPicture = $this->request->getVar('userimgLama');
            } else {
                if ($this->request->getVar('userimgLama') != "default.svg") {
                    unlink('img/users/' . $this->request->getVar('userimgLama'));
                }
                $namaPicture = $filePicture->getRandomName();
                $filePicture->move('img/users', $namaPicture);
            }

            $data = [
                'fullname' => $this->request->getVar('userfullname'),
                'userimg' => $namaPicture
            ];
            $this->userModel->updateUser($data, $userid);

            // $this->userModel->save(
            //     [
            //         'id' => $userid,
            //         'fullname' => $this->request->getVar('fullname'),
            //         'userimg' => $namaPicture
            //     ]
            // );

            $this->GroupModel->removeUserFromGroup($userid, $groupidold);
            $this->GroupModel->addUserToGroup($userid, $groupid);
            $msg = [
                'sukses' => $this->request->getVar('username') . ' Update successfully'
            ];
            echo json_encode($msg);
            // }
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('userid');
            $this->authModel->delete($id);
            $msg = [
                'sukses' => 'delete successfully'
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }
}
