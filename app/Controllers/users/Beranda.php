<?php

namespace App\Controllers\users;

use App\Controllers\BaseController;
use App\Models\users\SuratperingatanModel;
use App\Models\users\JadwalModel;
use App\Models\users\KegiatanModel;
use DateTime;

class Beranda extends BaseController
{
    protected $kegiatanModel;
    protected $jadwalModel;
    protected $suratPeringatanModel;

    public function __construct()
    {
        $this->kegiatanModel = new KegiatanModel();
        $this->jadwalModel = new JadwalModel();
        $this->suratPeringatanModel = new SuratperingatanModel();
    }
    public function index()
    {
        $date = new DateTime();
        $bulan = $date->format('m');
        $tahun = $date->format('Y');

        $data = [
            "title" => "PJLP | Beranda",
            "totalKegiatan" => $this->kegiatanModel->getJumlahKinerja(session('userid'), $bulan, $tahun),
            "totalJadwal" => $this->jadwalModel->getJumlahJadwalPerbulan(session('userid'), $bulan, $tahun),
            "totalSP" => $this->suratPeringatanModel->where(["userid" => session('userid')])->countAllResults(),
        ];
        return view('users/beranda', $data);
    }
}
