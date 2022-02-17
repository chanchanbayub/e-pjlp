<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\Admin\BidangModel;

class Bidang extends BaseController
{

    protected $bidangModel;

    public function __construct()
    {
        $this->bidangModel = new BidangModel();
    }

    public function index()
    {

        $data = [
            "title" => "PJLP | Admin Bidang",

        ];
        return view('admin/bidang', $data);
    }

    public function getBidang()
    {
        if ($this->request->isAjax()) {
            $bidang = $this->bidangModel->findAll();
            return json_encode($bidang);
        };
    }

    public function addBidang()
    {
        if ($this->request->isAJAX()) {
            $bidang =  $this->request->getVar("bidang_name");
            $kepala_bidang =  $this->request->getVar("kepala_bidang");
            $nip =  $this->request->getVar("nip");

            $data = [
                'bidang_name' => $bidang,
                'kepala_bidang' => $kepala_bidang,
                'nip' => $nip
            ];
            $dataBidang = $this->bidangModel->save($data);
            return json_encode($dataBidang);
        }
    }

    public function getDataBidang()
    {
        if ($this->request->isAJAX()) {
            $id_bidang = $this->request->getVar("id_bidang");
            $bidang = $this->bidangModel->where(["id_bidang" => $id_bidang])->first();

            return json_encode($bidang);
        }
    }
    public function update()
    {
        if ($this->request->isAJAX()) {
            $id_bidang = $this->request->getVar("id_bidang");
            $bidang =  $this->request->getVar("bidang_name");
            $kepala_bidang =  $this->request->getVar("kepala_bidang");
            $nip =  $this->request->getVar("nip");

            $data = [
                'id_bidang' => $id_bidang,
                'bidang_name' => $bidang,
                'kepala_bidang' => $kepala_bidang,
                'nip' => $nip
            ];
            $bidang_Data = $this->bidangModel->save($data);

            return json_encode($bidang_Data);
        }
    }
    public function delete()
    {
        if ($this->request->isAjax()) {
            $id_bidang = $this->request->getVar("id_bidang");

            $bidang = $this->bidangModel->delete($id_bidang);

            return json_encode($bidang);
        }
    }
}
