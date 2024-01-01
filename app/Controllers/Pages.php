<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index(): string
    {
        return view('pages/welcome_message');
    }

    public function informasi_mbkm()
    {
        return view('pages/informasi_mbkm');
    }

    public function tentang_kami()
    {
        return view('pages/tentang_kami');
    }
}
