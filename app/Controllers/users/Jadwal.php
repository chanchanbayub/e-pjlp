<?php

namespace App\Controllers\users;

use App\Controllers\BaseController;
use App\Models\Admin\BulanModel;
use App\Models\users\JadwalModel;
use DateTime;
use Mpdf\Mpdf;

class Jadwal extends BaseController
{
    protected $bulanModel;
    protected $jadwalModel;
    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
        $this->bulanModel = new BulanModel();
    }
    public function index($userid)
    {
        $date = new DateTime();
        $bulan = $date->format("m");
        $tahun = $date->format("Y");

        $currentPage = $this->request->getVar("page") ? $this->request->getVar('page') : 1;

        $data = [
            "title" => "PJLP | Jadwal Kerja",
            "bulan" => $this->bulanModel->findAll(),
            "jadwal" => $this->jadwalModel->getJadwalByUserid($userid, $bulan, $tahun)->paginate(10, 'jadwal'),
            "pager" => $this->jadwalModel->pager,
            "totalJadwalPerbulan" => $this->jadwalModel->getJumlahJadwalPerbulan($userid, $bulan, $tahun),
            'currentPage' => $currentPage
        ];
        return view('users/jadwal', $data);
    }

    public function getJadwalById($userid)
    {
        if ($this->request->isAjax()) {

            $filter = $this->request->getVar("filter");

            $date = new DateTime();
            $bulan = $date->format("m");
            $tahun = $date->format("Y");

            if ($filter) {
                $jadwalData = $this->jadwalModel->getJadwalById($userid, $filter, $tahun);
                $total = $this->jadwalModel->getJumlahJadwalPerbulan($userid, $filter, $tahun);
            } else {
                $jadwalData = $this->jadwalModel->getJadwalById($userid, $bulan, $tahun);
                $total = $this->jadwalModel->getJumlahJadwalPerbulan($userid, $bulan, $tahun);
            }

            $data = [
                'jadwal' => $jadwalData,
                'total' => $total
            ];

            return json_encode($data);
        }
    }
}
