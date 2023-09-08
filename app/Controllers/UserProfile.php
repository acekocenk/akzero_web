<?php

namespace App\Controllers;

// use App\Models\authModel;
use Myth\Auth\Models\UserModel;

class UserProfile extends BaseController
{
    protected $authModel, $userModel;
    public function __construct()
    {
        // $this->authModel = new authModel();
        $this->userModel = new UserModel();
        // $this->abiproModel = new abiproModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'User Profile',
            // 'user' =>  $this->userModel->getUserGroup($userid)
        ];
        return view('userprofile/index', $data);
    }

    public function loaddata()
    {
        if ($this->request->isAJAX()) {
            $userid = $this->request->getVar('userid');
            $data = [
                'title' => 'User Profile Detail',
                'user' =>  $this->userModel->getUserGroup($userid)
            ];
            $msg = [
                'view' => view('userprofile/view', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }

        // if (empty($this->userModel->getUserGroup($userid))) {
        //     return redirect()->to(base_url('/'));
        // }
        // return view('userprofile/view', $data);

    }
    public function create()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Add user',
                'validation' =>  \Config\Services::validation(),
                // 'abipro' => $this->abiproModel->hutimasList()
            ];
            $msg = [
                'create' => view('userprofile/create', $data)
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
                'username' => [
                    'rules' => 'required|is_unique[users.username]',
                    'errors' => [
                        'required' => 'The user field is required .',
                        'is_unique' => 'The user field must contain a unique value.'
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
                        'username' => validation_show_error('username'),
                        'email' => validation_show_error('email'),
                        'telp' => validation_show_error('telp'),
                    ]
                ];
            } else {

                $slug = url_title($this->request->getVar('username'), '-', true);
                $this->authModel->save(
                    [
                        'username' => ucfirst($this->request->getVar('username')),
                        'address' => $this->request->getVar('address'),
                        'telp' => $this->request->getVar('telp'),
                        'email' => $this->request->getVar('email'),
                        'acccode' => $this->request->getVar('acccode'),
                        'slug' => $slug
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('username') . ' added successfully'
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
                'title' => 'Edit user',
                'user' => $this->authModel->userList($slug),
                // 'abipro' => $this->abiproModel->hutimasList()
            ];
            $msg = [
                'edit' => view('userprofile/edit', $data)
            ];
            echo json_encode($msg);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(' Not Found');
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $userLama = $this->authModel->userList($this->request->getVar('slug'));

            if ($userLama['username'] == $this->request->getVar('username')) {
                $rule_username = 'required';
            } else {
                $rule_username = 'required|is_unique[users.username]';
            }

            $valid = $this->validate([
                'username' => [
                    'rules' => $rule_username,
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
                        'username' => validation_show_error('username'),
                        'email' => validation_show_error('email'),
                        'telp' => validation_show_error('telp'),
                    ]
                ];
            } else {
                $slug = url_title($this->request->getVar('username'), '-', true);
                $this->authModel->save(
                    [
                        'id' => $this->request->getVar('id'),
                        'username' => ucfirst($this->request->getVar('username')),
                        'address' => $this->request->getVar('address'),
                        'telp' => $this->request->getVar('telp'),
                        'email' => $this->request->getVar('email'),
                        'acccode' => $this->request->getVar('acccode'),
                        'slug' => $slug
                    ]
                );
                $msg = [
                    'sukses' => $this->request->getVar('username') . ' Update successfully'
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
