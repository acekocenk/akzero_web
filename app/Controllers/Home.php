<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];
        return view('home', $data);
    }
    public function about()
    {
        $data = [
            'title' => 'about'
        ];
        return view('about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'contact us'
        ];
        return view('contact', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'contact us'
        ];
        return view('auth/register', $data);
    }

    public function user()
    {
        $data = [
            'title' => 'contact us'
        ];
        return view('user/index', $data);
    }

    public function notaccess()
    {
        $data = [
            'title' => 'notaccess'
        ];
        return view('notaccess', $data);
    }
}
