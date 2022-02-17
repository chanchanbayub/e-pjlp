<?php

namespace App\Controllers\users;

use App\Controllers\BaseController;
use App\Models\Admin\BulanModel;
use App\Models\users\PerbaikanabsenModel;
use App\Models\users\AbsensiModel;
use App\Models\users\JadwalModel;
use App\Models\users\LatetimeModel;

use DateTime;

// use Mpdf\Mpdf;

class Absensi extends BaseController
{
    protected $perbaikanabsenModel;
    protected $absensiModel;
    protected $jadwalModel;
    protected $bulanModel;
    protected $lateTimeModel;

    public function __construct()
    {
        $this->absensiModel = new AbsensiModel();
        $this->jadwalModel = new JadwalModel();
        $this->bulanModel = new BulanModel();
        $this->lateTimeModel = new LatetimeModel();
        $this->perbaikanabsenModel = new PerbaikanabsenModel();
        // $this->perbaikanabsenModel = new PerbaikanabsenModel();
    }
    public function index()
    {

        $data = [
            "title" => "PJLP | Absensi"
        ];

        return view('users/absensi', $data);
    }

    public function getRowAbsensi($userid)
    {
        if ($this->request->isAJAX()) {
            $rowAbsensi = $this->absensiModel->getRowAbsensiNoDate($userid);

            if ($rowAbsensi["checktype"] == 0) {
                $time  = $rowAbsensi["checktime"];
                $waktu = explode(" ", $time);
                $tanggal = $waktu[0];
                $jam = $waktu[1];
                $getJadwal = $this->jadwalModel->getJadwal($userid, $tanggal);

                // start Kurang dari shift masuk
                if ($jam <= $getJadwal["shift_masuk"]) {
                    $interval = "00:00:00";
                    $dataDbLateTime = $this->lateTimeModel->getIdLateTimeWithJoin($rowAbsensi["id"]);
                    if ($dataDbLateTime["id"] !== $rowAbsensi["id"]) {
                        $this->lateTimeModel->save([
                            'idlatetime' => $rowAbsensi["id"],
                            'useridLatetime' => $rowAbsensi["userid"],
                            'tanggal'  => $tanggal,
                            'checktype' => $rowAbsensi["checktype"],
                            'interval' => $interval
                        ]);
                    } else if ($dataDbLateTime["idlatetime"] === $rowAbsensi["id"]) {
                        $this->lateTimeModel->update($dataDbLateTime["latetime_id"], [
                            'latetime_id'   => $dataDbLateTime["latetime_id"],
                            'idlatetime' => $rowAbsensi["id"],
                            'useridLatetime' => $rowAbsensi["userid"],
                            'tanggal'  => $tanggal,
                            'checktype' => $rowAbsensi["checktype"],
                            'interval' => $interval
                        ]);
                    }
                } else if ($jam > $getJadwal["shift_masuk"]) {
                    $jam_masuk = date_create($jam);
                    $shift_masuk = date_create($getJadwal["shift_masuk"]);
                    $diff = date_diff($jam_masuk, $shift_masuk);
                    $interval = $diff->format("%H:%I:%S");
                    $dataDbLateTime = $this->lateTimeModel->getIdLateTimeWithJoin($rowAbsensi["id"]);
                    if ($dataDbLateTime["idlatetime"] !== $rowAbsensi["id"]) {
                        $this->lateTimeModel->save([
                            // 'latetime_id'   => $rowAbsensi["id"],
                            'idlatetime' => $rowAbsensi["id"],
                            'useridLatetime' => $rowAbsensi["userid"],
                            'tanggal'  => $tanggal,
                            'checktype' => $rowAbsensi["checktype"],
                            'interval' => $interval
                        ]);
                    } else if ($dataDbLateTime["idlatetime"] == $rowAbsensi["id"]) {
                        $this->lateTimeModel->update($dataDbLateTime["latetime_id"], [
                            'latetime_id'   => $dataDbLateTime["latetime_id"],
                            'idlatetime' => $rowAbsensi["id"],
                            'useridLatetime' => $rowAbsensi["userid"],
                            'tanggal'  => $tanggal,
                            'checktype' => $rowAbsensi["checktype"],
                            'interval' => $interval
                        ]);
                    }
                }
            } else if ($rowAbsensi["checktype"] == 1) {
                $time  = $rowAbsensi["checktime"];
                $waktu = explode(" ", $time);
                $tanggal = $waktu[0];
                $jam = $waktu[1];
                $getJadwal = $this->jadwalModel->getJadwal($userid, $tanggal);
                if ($tanggal == $getJadwal["tanggal_pulang"]) {
                    if ($jam >= $getJadwal["shift_pulang"]) {
                        $interval = "00:00:00";
                        $dataDbLateTime = $this->lateTimeModel->getIdLateTimeWithJoin($rowAbsensi["id"]);
                        if ($dataDbLateTime["idlatetime"] !== $rowAbsensi["id"]) {
                            $this->lateTimeModel->save([
                                'idlatetime' => $rowAbsensi["id"],
                                'useridLatetime' => $rowAbsensi["userid"],
                                'tanggal'  => $tanggal,
                                'checktype' => $rowAbsensi["checktype"],
                                'interval' => $interval
                            ]);
                        } else if ($dataDbLateTime["idlatetime"] === $rowAbsensi["id"]) {
                            $this->lateTimeModel->update($dataDbLateTime["latetime_id"], [
                                'latetime_id'   => $dataDbLateTime["latetime_id"],
                                'idlatetime' => $rowAbsensi["id"],
                                'useridLatetime' => $rowAbsensi["userid"],
                                'tanggal'  => $tanggal,
                                'checktype' => $rowAbsensi["checktype"],
                                'interval' => $interval
                            ]);
                        }
                    } else if ($jam < $getJadwal["shift_pulang"]) {
                        $jam_masuk = date_create($jam);
                        $shift_pulang = date_create($getJadwal["shift_pulang"]);
                        $diff = date_diff($jam_masuk, $shift_pulang);
                        $interval = $diff->format("%H:%I:%S");
                        $dataDbLateTime = $this->lateTimeModel->getIdLateTimeWithJoin($rowAbsensi["id"]);
                        if ($dataDbLateTime["idlatetime"] !== $rowAbsensi["id"]) {
                            $this->lateTimeModel->save([
                                'idlatetime' => $rowAbsensi["id"],
                                'useridLatetime' => $rowAbsensi["userid"],
                                'tanggal'  => $tanggal,
                                'checktype' => $rowAbsensi["checktype"],
                                'interval' => $interval
                            ]);
                        } else if ($dataDbLateTime["idlatetime"] === $rowAbsensi["id"]) {
                            $this->lateTimeModel->update($dataDbLateTime["latetime_id"], [
                                'latetime_id'   => $dataDbLateTime["latetime_id"],
                                'idlatetime' => $rowAbsensi["id"],
                                'useridLatetime' => $rowAbsensi["userid"],
                                'tanggal'  => $tanggal,
                                'checktype' => $rowAbsensi["checktype"],
                                'interval' => $interval
                            ]);
                        }
                    }
                } else if ($tanggal < $getJadwal["tanggal_pulang"]) {
                    $tanggal_pulang = date_create($getJadwal["tanggal_pulang"]);
                    $tanggal_pulang = date_format($tanggal_pulang, 'Y-m-d');
                    $shift_pulang = date_create($getJadwal["shift_pulang"]);
                    $shift_pulang = date_format($shift_pulang, 'H:i:s');
                    // extend (tanggal : jam)
                    $pulang  = $tanggal_pulang . ' ' . $shift_pulang;

                    $timeOut = strtotime($pulang);

                    $tanggalAbsen = strtotime($time);

                    $diff = $timeOut - $tanggalAbsen;

                    if ($diff < 24 * 60 * 60) {
                        $interval = gmdate("H:i:s", $diff);
                    } else {
                        $hours = floor($diff / 3600);
                        $minute = floor(($diff - $hours * 3600) / 60);
                        $second = floor($diff - ($hours * 3600) - ($minute * 60));

                        $interval =  "$hours:$minute:$second";
                    }

                    $dataDbLateTime = $this->lateTimeModel->getIdLateTimeWithJoin($rowAbsensi["id"]);
                    if ($dataDbLateTime["idlatetime"] !== $rowAbsensi["id"]) {
                        $this->lateTimeModel->save([
                            'idlatetime' => $rowAbsensi["id"],
                            'useridLatetime' => $rowAbsensi["userid"],
                            'tanggal'  => $tanggal,
                            'checktype' => $rowAbsensi["checktype"],
                            'interval' => $interval
                        ]);
                    } else if ($dataDbLateTime["idlatetime"] === $rowAbsensi["id"]) {
                        $this->lateTimeModel->update($dataDbLateTime["latetime_id"], [
                            'latetime_id'   => $dataDbLateTime["latetime_id"],
                            'idlatetime' => $rowAbsensi["id"],
                            'useridLatetime' => $rowAbsensi["userid"],
                            'tanggal'  => $tanggal,
                            'checktype' => $rowAbsensi["checktype"],
                            'interval' => $interval
                        ]);
                    }
                }
            }

            $data = [
                'jadwal'   => $getJadwal,
                'lateTime'  => $this->lateTimeModel->getIdLateTimeWithJoin($rowAbsensi["id"])
            ];

            return json_encode($data);
        }
    }



    public function rekapAbsen($userid)
    {
        $date = new DateTime();
        $bulan = $date->format("m");
        $tahun = $date->format("Y");

        $filter = $this->request->getVar("filter");

        if ($filter) {
            $jadwalData = $this->jadwalModel->getJadwalById($userid, $filter, $tahun);
            $lateTime = $this->lateTimeModel->getUsersWithDateTime($userid, $filter, $tahun);
            $perbaikanAbsen = $this->perbaikanabsenModel->getPerbaikanWithFilter($userid, $filter, $tahun);
        } else {
            $jadwalData = $this->jadwalModel->getJadwalById($userid, $bulan, $tahun);
            $lateTime = $this->lateTimeModel->getUsersWithDateTime($userid, $bulan, $tahun);
            $perbaikanAbsen = $this->perbaikanabsenModel->getPerbaikanWithMonth($userid, $bulan, $tahun);
        }

        $rekapAbsen = [];
        foreach ($jadwalData as $rows) :
            $rowAbsenMasuk = $this->absensiModel->getRowDataAbsensi($rows["userid"], $rows["tanggal_masuk"]);
            $rekapAbsen[] = $this->absensiModel->getResultWithDateTime($rowAbsenMasuk["userid"], $rows["tanggal_masuk"]);

            for ($i = 0; $i < count($rekapAbsen); $i++) {
                for ($j = 0; $j < count($rekapAbsen[$i]); $j++) {
                    // Checktype = 0 (masuk)
                    if ($rekapAbsen[$i][$j]["checktype"] == 0) {
                        $time = $rekapAbsen[$i][$j]["checktime"];
                        $arrTime = explode(" ", $time);
                        $tanggal = $arrTime[0];
                        $jam = $arrTime[1];
                        if ($tanggal == $rows["tanggal_masuk"]) {
                            if ($jam <= $rows["shift_masuk"]) {
                                $interval = "00:00:00";
                                $dataDbLateTime = $this->lateTimeModel->getIdLateTimeWithJoin($rekapAbsen[$i][$j]["id"]);
                                if ($dataDbLateTime["idlatetime"] != $rekapAbsen[$i][$j]["id"]) {
                                    $this->lateTimeModel->save([
                                        'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                        'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                        'tanggal' => $tanggal,
                                        'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                        'interval'  => $interval
                                    ]);
                                } else if ($dataDbLateTime["idlatetime"] == $rekapAbsen[$i][$j]["id"]) {
                                    $this->lateTimeModel->update($dataDbLateTime["latetime_id"], [
                                        'latetime_id' => $dataDbLateTime["latetime_id"],
                                        'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                        'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                        'tanggal' => $tanggal,
                                        'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                        'interval'  => $interval
                                    ]);
                                }
                            } else if ($jam > $rows["shift_masuk"]) {
                                $jam_masuk = date_create($jam);
                                $shift_masuk = date_create($rows["shift_masuk"]);
                                $diff = date_diff($jam_masuk, $shift_masuk);
                                $interval = $diff->format("%H:%I:%S");
                                $dataDbLateTime = $this->lateTimeModel->getIdLateTimeWithJoin($rekapAbsen[$i][$j]["id"]);
                                if ($dataDbLateTime["idlatetime"] != $rekapAbsen[$i][$j]["id"]) {
                                    $this->lateTimeModel->save([
                                        'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                        'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                        'tanggal'  => $tanggal,
                                        'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                        'interval' => $interval
                                    ]);
                                } else if ($dataDbLateTime["idlatetime"] == $rekapAbsen[$i][$j]["id"]) {
                                    $this->lateTimeModel->update($dataDbLateTime["latetime_id"], [
                                        'latetime_id'   => $dataDbLateTime["latetime_id"],
                                        'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                        'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                        'tanggal'  => $tanggal,
                                        'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                        'interval' => $interval
                                    ]);
                                }
                            }
                        }
                    } else if ($rekapAbsen[$i][$j]["checktype"] == 1) {
                        $time = $rekapAbsen[$i][$j]["checktime"];
                        $arrTime = explode(" ", $time);
                        $tanggal = $arrTime[0];
                        $jam = $arrTime[1];
                        if ($tanggal == $rows["tanggal_pulang"]) {
                            if ($jam >= $rows["shift_pulang"]) {
                                $interval = "00:00:00";
                                $dataDbLateTime = $this->lateTimeModel->getIdLateTimeWithJoin($rekapAbsen[$i][$j]["id"]);
                                if ($dataDbLateTime["idlatetime"] != $rekapAbsen[$i][$j]["id"]) {
                                    $this->lateTimeModel->save([
                                        'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                        'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                        'tanggal' => $tanggal,
                                        'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                        'interval'  => $interval
                                    ]);
                                } else if ($dataDbLateTime["idlatetime"] == $rekapAbsen[$i][$j]["id"]) {
                                    $this->lateTimeModel->update($dataDbLateTime["latetime_id"], [
                                        'latetime_id' => $dataDbLateTime["latetime_id"],
                                        'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                        'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                        'tanggal' => $tanggal,
                                        'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                        'interval'  => $interval
                                    ]);
                                }
                            } else if ($jam < $rows["shift_pulang"]) {
                                $jam_pulang = date_create($jam);
                                $shift_pulang = date_create($rows["shift_pulang"]);
                                $diff = date_diff($jam_pulang, $shift_pulang);
                                $interval = $diff->format("%H:%I:%S");
                                $dataDbLateTime = $this->lateTimeModel->getIdLateTimeWithJoin($rekapAbsen[$i][$j]["id"]);
                                if ($dataDbLateTime["idlatetime"] != $rekapAbsen[$i][$j]["id"]) {
                                    $this->lateTimeModel->save([
                                        'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                        'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                        'tanggal'  => $tanggal,
                                        'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                        'interval' => $interval
                                    ]);
                                } else if ($dataDbLateTime["idlatetime"] == $rekapAbsen[$i][$j]["id"]) {
                                    $this->lateTimeModel->update($dataDbLateTime["latetime_id"], [
                                        'latetime_id'   => $dataDbLateTime["latetime_id"],
                                        'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                        'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                        'tanggal'  => $tanggal,
                                        'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                        'interval' => $interval
                                    ]);
                                }
                            }
                        } else if ($tanggal < $rows["tanggal_pulang"]) {
                            $tanggal_pulang = date_create($rows["tanggal_pulang"]);
                            $tanggal_pulang = date_format($tanggal_pulang, 'Y-m-d');

                            $jam_pulang = date_create($rows["shift_pulang"]);
                            $jam_pulang = date_format($jam_pulang, 'H:i:s');

                            $jadwal_pulang = $tanggal_pulang  . ' ' . $jam_pulang;

                            $absenPulang = $time;

                            $timeOut = strtotime($jadwal_pulang);
                            $checkout = strtotime($absenPulang);

                            $diff = $timeOut - $checkout;
                            if ($diff < 24 * 60 * 60) {
                                $interval = gmdate("H:i:s", $diff);
                            } else {
                                $hours = floor($diff / 3600);
                                $minute = floor(($diff - $hours * 3600) / 60);
                                $second = floor($diff - ($hours * 3600) - ($minute * 60));

                                $interval =  "$hours:$minute:$second";
                            }

                            $dataDbLateTime = $this->lateTimeModel->getIdLateTimeWithJoin($rekapAbsen[$i][$j]["id"]);
                            if ($dataDbLateTime["idlatetime"] != $rekapAbsen[$i][$j]["id"]) {
                                $this->lateTimeModel->save([
                                    'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                    'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                    'tanggal'  => $tanggal,
                                    'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                    'interval' => $interval
                                ]);
                            } else if ($dataDbLateTime["idlatetime"] == $rekapAbsen[$i][$j]["id"]) {
                                $this->lateTimeModel->update($dataDbLateTime["latetime_id"], [
                                    'latetime_id'   => $dataDbLateTime["latetime_id"],
                                    'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                    'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                    'tanggal'  => $tanggal,
                                    'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                    'interval' => $interval
                                ]);
                            }
                        }
                    }
                }
            }

        endforeach;

        $currentPage = $this->request->getVar("page") ? $this->request->getVar('page') : 1;

        $data = [
            "title" => "PJLP | Rekap Absensi",
            "bulan" => $this->bulanModel->findAll(),
            'lateTime'   => $lateTime->paginate(10, 'latetime'),
            'pager' => $this->lateTimeModel->pager,
            'currentPage' => $currentPage,
            'perbaikanAbsen' => $perbaikanAbsen->paginate(10, 'perbaikanabsen'),
        ];

        return view("users/rekap_absen", $data);
    }

    public function getResultAbsensi($userid)
    {
        if ($this->request->isAJAX()) {
            $filter = $this->request->getVar("filter");

            $date = new DateTime();
            $bulan = $date->format("m");
            $tahun = $date->format("Y");

            if ($filter) {
                $jadwalData = $this->jadwalModel->getJadwalById($userid, $filter, $tahun);
                $lateTime = $this->lateTimeModel->getUsersWithDateTime($userid, $filter, $tahun);
                $perbaikanAbsen = $this->perbaikanabsenModel->getPerbaikanWithFilter($userid, $filter, $tahun);
            } else {
                $jadwalData = $this->jadwalModel->getJadwalById($userid, $bulan, $tahun);
                $lateTime = $this->lateTimeModel->getUsersWithDateTime($userid, $bulan, $tahun);
                $perbaikanAbsen = $this->perbaikanabsenModel->getPerbaikanWithMonth($userid, $bulan, $tahun);
            }
            // dd($lateTime);
            // dd($perbaikanAbsen);
            $rekapAbsen = [];
            foreach ($jadwalData as $rows) :
                $rowAbsenMasuk = $this->absensiModel->getRowDataAbsensi($rows["userid"], $rows["tanggal_masuk"]);
                $rekapAbsen[] = $this->absensiModel->getResultWithDateTime($rowAbsenMasuk["userid"], $rows["tanggal_masuk"]);
                // dd($rekapAbsen);
                for ($i = 0; $i < count($rekapAbsen); $i++) {
                    for ($j = 0; $j < count($rekapAbsen[$i]); $j++) {
                        // Checktype = 0 (masuk)
                        if ($rekapAbsen[$i][$j]["checktype"] == 0) {
                            $time = $rekapAbsen[$i][$j]["checktime"];
                            $arrTime = explode(" ", $time);
                            $tanggal = $arrTime[0];
                            $jam = $arrTime[1];
                            if ($tanggal == $rows["tanggal_masuk"]) {
                                if ($jam <= $rows["shift_masuk"]) {
                                    $interval = "00:00:00";
                                    $dataDbLateTime = $this->lateTimeModel->getIdLateTimeWithJoin($rekapAbsen[$i][$j]["id"]);
                                    if ($dataDbLateTime["idlatetime"] != $rekapAbsen[$i][$j]["id"]) {
                                        $this->lateTimeModel->save([
                                            'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                            'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                            'tanggal' => $tanggal,
                                            'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                            'interval'  => $interval
                                        ]);
                                    } else if ($dataDbLateTime["idlatetime"] == $rekapAbsen[$i][$j]["id"]) {
                                        $this->lateTimeModel->update($dataDbLateTime["latetime_id"], [
                                            'latetime_id' => $dataDbLateTime["latetime_id"],
                                            'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                            'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                            'tanggal' => $tanggal,
                                            'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                            'interval'  => $interval
                                        ]);
                                    }
                                } else if ($jam > $rows["shift_masuk"]) {
                                    $jam_masuk = date_create($jam);
                                    $shift_masuk = date_create($rows["shift_masuk"]);
                                    $diff = date_diff($jam_masuk, $shift_masuk);
                                    $interval = $diff->format("%H:%I:%S");
                                    $dataDbLateTime = $this->lateTimeModel->getIdLateTimeWithJoin($rekapAbsen[$i][$j]["id"]);
                                    if ($dataDbLateTime["idlatetime"] != $rekapAbsen[$i][$j]["id"]) {
                                        $this->lateTimeModel->save([
                                            'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                            'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                            'tanggal'  => $tanggal,
                                            'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                            'interval' => $interval
                                        ]);
                                    } else if ($dataDbLateTime["idlatetime"] == $rekapAbsen[$i][$j]["id"]) {
                                        $this->lateTimeModel->update($dataDbLateTime["latetime_id"], [
                                            'latetime_id'   => $dataDbLateTime["latetime_id"],
                                            'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                            'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                            'tanggal'  => $tanggal,
                                            'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                            'interval' => $interval
                                        ]);
                                    }
                                }
                            }
                        } else if ($rekapAbsen[$i][$j]["checktype"] == 1) {
                            $time = $rekapAbsen[$i][$j]["checktime"];
                            $arrTime = explode(" ", $time);
                            $tanggal = $arrTime[0];
                            $jam = $arrTime[1];
                            if ($tanggal == $rows["tanggal_pulang"]) {
                                if ($jam >= $rows["shift_pulang"]) {
                                    $interval = "00:00:00";
                                    $dataDbLateTime = $this->lateTimeModel->getIdLateTimeWithJoin($rekapAbsen[$i][$j]["id"]);
                                    if ($dataDbLateTime["idlatetime"] != $rekapAbsen[$i][$j]["id"]) {
                                        $this->lateTimeModel->save([
                                            'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                            'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                            'tanggal' => $tanggal,
                                            'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                            'interval'  => $interval
                                        ]);
                                    } else if ($dataDbLateTime["idlatetime"] == $rekapAbsen[$i][$j]["id"]) {
                                        $this->lateTimeModel->update($dataDbLateTime["latetime_id"], [
                                            'latetime_id' => $dataDbLateTime["latetime_id"],
                                            'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                            'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                            'tanggal' => $tanggal,
                                            'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                            'interval'  => $interval
                                        ]);
                                    }
                                } else if ($jam < $rows["shift_pulang"]) {
                                    $jam_pulang = date_create($jam);
                                    $shift_pulang = date_create($rows["shift_pulang"]);
                                    $diff = date_diff($jam_pulang, $shift_pulang);
                                    $interval = $diff->format("%H:%I:%S");
                                    $dataDbLateTime = $this->lateTimeModel->getIdLateTimeWithJoin($rekapAbsen[$i][$j]["id"]);
                                    if ($dataDbLateTime["idlatetime"] != $rekapAbsen[$i][$j]["id"]) {
                                        $this->lateTimeModel->save([
                                            'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                            'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                            'tanggal'  => $tanggal,
                                            'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                            'interval' => $interval
                                        ]);
                                    } else if ($dataDbLateTime["idlatetime"] == $rekapAbsen[$i][$j]["id"]) {
                                        $this->lateTimeModel->update($dataDbLateTime["latetime_id"], [
                                            'latetime_id'   => $dataDbLateTime["latetime_id"],
                                            'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                            'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                            'tanggal'  => $tanggal,
                                            'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                            'interval' => $interval
                                        ]);
                                    }
                                }
                            } else if ($tanggal < $rows["tanggal_pulang"]) {
                                $tanggal_pulang = date_create($rows["tanggal_pulang"]);
                                $tanggal_pulang = date_format($tanggal_pulang, 'Y-m-d');

                                $jam_pulang = date_create($rows["shift_pulang"]);
                                $jam_pulang = date_format($jam_pulang, 'H:i:s');

                                $jadwal_pulang = $tanggal_pulang  . ' ' . $jam_pulang;

                                $absenPulang = $time;

                                $timeOut = strtotime($jadwal_pulang);
                                $checkout = strtotime($absenPulang);

                                $diff = $timeOut - $checkout;
                                if ($diff < 24 * 60 * 60) {
                                    $interval = gmdate("H:i:s", $diff);
                                } else {
                                    $hours = floor($diff / 3600);
                                    $minute = floor(($diff - $hours * 3600) / 60);
                                    $second = floor($diff - ($hours * 3600) - ($minute * 60));

                                    $interval =  "$hours:$minute:$second";
                                }

                                $dataDbLateTime = $this->lateTimeModel->getIdLateTimeWithJoin($rekapAbsen[$i][$j]["id"]);
                                if ($dataDbLateTime["idlatetime"] != $rekapAbsen[$i][$j]["id"]) {
                                    $this->lateTimeModel->save([
                                        'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                        'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                        'tanggal'  => $tanggal,
                                        'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                        'interval' => $interval
                                    ]);
                                } else if ($dataDbLateTime["idlatetime"] == $rekapAbsen[$i][$j]["id"]) {
                                    $this->lateTimeModel->update($dataDbLateTime["latetime_id"], [
                                        'latetime_id'   => $dataDbLateTime["latetime_id"],
                                        'idlatetime' => $rekapAbsen[$i][$j]["id"],
                                        'useridLatetime' => $rekapAbsen[$i][$j]["userid"],
                                        'tanggal'  => $tanggal,
                                        'checktype' => $rekapAbsen[$i][$j]["checktype"],
                                        'interval' => $interval
                                    ]);
                                }
                            }
                        }
                    }
                }

            endforeach;
            $data = [
                'lateTime'   => $lateTime,
                'perbaikanAbsen' => $perbaikanAbsen,
            ];

            return json_encode($data);
        }
    }
}
