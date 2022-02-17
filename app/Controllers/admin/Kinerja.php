<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Kinerja extends BaseController
{
    public function index()
    {
        $data = [
            "title" => "PJLP | Admin Kinerja",
        ];
        return view('admin/kinerja', $data);
    }
}
