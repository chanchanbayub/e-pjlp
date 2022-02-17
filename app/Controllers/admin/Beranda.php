<?php

namespace App\Controllers\admin;

use CodeIgniter\I18n\Time;



use App\Controllers\BaseController;
use App\Models\Admin\UserinfoModel;

class Beranda extends BaseController
{

    protected $userInfoModel;

    public function __construct()
    {
        $this->userInfoModel = new UserinfoModel();
    }

    public function index()
    {
        $data = [
            "title" => "PJLP | Admin Beranda",
            "totalAnggota" => $this->userInfoModel->where(["Privilege" => 0])->countAllResults(),
            "totalAdmin" => $this->userInfoModel->where(["Privilege" => 14])->countAllResults(),
            "totalKasie" => $this->userInfoModel->where(["Privilege" => 2])->countAllResults()
        ];
        return view('admin/beranda', $data);
    }
}
