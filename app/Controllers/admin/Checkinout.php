<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\CheckinoutModel;
use App\Models\Admin\UserinfoModel;
use App\Models\Admin\BulanModel;
use App\Models\Admin\JadwalModel;
use App\Models\Admin\PerbaikanabsenModel;
use App\Models\Users\LateTimeModel;
use DateTime;
use Mpdf\Mpdf;

class Checkinout extends BaseController
{
  protected $lateTimeModel;
  protected $checkinoutModel;
  protected $jadwalModel;
  protected $bulanModel;
  protected $userinfoModel;
  protected $perbaikanabsenModel;
  protected $mpdf;

  public function __construct()
  {
    $this->checkinoutModel = new CheckinoutModel();
    $this->jadwalModel = new JadwalModel();
    $this->lateTimeModel = new LateTimeModel();
    $this->bulanModel = new BulanModel();
    $this->userinfoModel = new UserinfoModel();
    $this->perbaikanabsenModel = new PerbaikanabsenModel();
  }

  public function index($userid)
  {
    $data = [
      "title" => "PJLP | Admin Absensi",
      "bulan" => $this->bulanModel->findAll(),
      "anggota" => $this->userinfoModel->where(["userid" => $userid])->first()
    ];
    return view('admin/absensi', $data);
  }

  public function rekapAbsen($userid)
  {
    if ($this->request->isAJAX()) {
      $filter = $this->request->getVar("filter");
      $date = new DateTime();
      $tahun = $date->format("Y");
      $bulan = $date->format("m");

      if ($filter) {
        // Total Terlambat Absensi
        $totalLateTime = $this->lateTimeModel->getTotalTime($userid, $filter, $tahun);
        // LateTime
        $lateTime = $this->lateTimeModel->getIdWithDateTime($userid, $filter, $tahun);
        // gaji perbulan 
        $perbaikanAbsen = $this->perbaikanabsenModel->getPerbaikanWithMonth($userid, $filter, $tahun);
      } else {

        $totalLateTime = $this->lateTimeModel->getTotalTime($userid, $bulan, $tahun);

        $lateTime = $this->lateTimeModel->getIdWithDateTime($userid, $bulan, $tahun);

        $perbaikanAbsen = $this->perbaikanabsenModel->getPerbaikanWithMonth($userid, $bulan, $tahun);
      }

      $total = $this->lateTimeModel->getTotalLateTime($userid, $tahun);

      $data = [
        'lateTime' => $lateTime,
        'totalPerbulan' =>  $totalLateTime,
        'totalPertahun' =>  $total,
        'perbaikanAbsen' => $perbaikanAbsen
      ];
      return json_encode($data);
    }
  }

  public function cetakPdf($userid)
  {
    $filter = $this->request->getVar("filter");
    $date = new DateTime();
    $tahun = $date->format("Y");
    $bulan = $date->format("m");
    if ($filter) {
      // Jadwal Data
      $jadwalData = $this->jadwalModel->getJadwalById($userid, $filter, $tahun);
      // Total Terlambat Absensi
      $totalLateTime = $this->lateTimeModel->getTotalTime($userid, $filter, $tahun);
      // LateTime
      $lateTime = $this->lateTimeModel->getIdWithDateTime($userid, $filter, $tahun);
      // gaji perbulan 
      $perbaikanAbsen = $this->perbaikanabsenModel->getPerbaikanWithMonth($userid, $filter, $tahun);
    } else {
      $jadwalData = $this->jadwalModel->getJadwalById($userid, $bulan, $tahun);

      $totalLateTime = $this->lateTimeModel->getTotalTime($userid, $bulan, $tahun);

      $lateTime = $this->lateTimeModel->getIdWithDateTime($userid, $bulan, $tahun);

      $perbaikanAbsen = $this->perbaikanabsenModel->getPerbaikanWithMonth($userid, $bulan, $tahun);
    }

    $total = $this->lateTimeModel->getTotalLateTime($userid, $tahun);

    $mpdf = new Mpdf();

    $html = '<!DOCTYPE html>
        <html lang="en">
        <head>
        <style>
        * {
            box-sizing: border-box;
            margin: 0 auto;
            padding: 0;
          }
          .container {
            width: 100%;
            padding-left: 80px;
            padding-right: 80px;
          
          }
          .banner {
            display: inline-block;
            width: 100%;
            margin: 0 auto;
            padding-top: 10px;
            padding-bottom: 10px;
          }
          .title {
            margin: 0 auto;
            padding: 5px 10px;
          }
          .title h2 {
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
           
          }
          .sub-title {
            margin: 0 auto;
            padding: 5px 10px;
          }
          .sub-title p {
            text-transform: capitalize;
            font-size: 16px;
            font-weight: bold;
            padding: 3px 0;
          }
          .content {
            /* display: inline-block; */
            margin: 0 auto;
            padding: 5px 10px;
          }
          .table1 {
            font-family: sans-serif;
            color: #232323;
            border-collapse: collapse;
          }
          .table1,
          th,
          td {
            border: 1px solid #999;
            padding: 5px 20px;
          }
          .section-footer {
            /* border: 1px solid black; */
            display: flex;
            justify-content: space-between;
            align-items: center;
            align-content: center;
            width: 100%;
            padding: 10px 0;
          }
          .left {
            float:left;
           }
           .right {
            float:right;
            }
          .left p {
            padding-bottom: 20px;
          }
         
          .right p {
            padding-bottom: 20px;
          }
          
          
        </style>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>';
    $html .=  '<div class="container">
                <div class="banner">
                    <div class="title">
                         <h2>Dinas Perhubungan DKI Jakarta</h2>
                    </div>
                     <hr>
                    <div class="sub-title">
                        <p>Nama :</p>
                        <p>No PJLP :</p>
                        <p>Bidang :</p>
                    </div>
                     <hr>
                     <div class="content">
                        <table class="table1">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Terlambat</th>
                            </tr>';

    $i = 1;
    foreach ($lateTime as $lateTime) {
      $html .= '<tr>
                                    <td>' . $i++ . '</td>
                                    <td>' . $lateTime["tanggal"] . '</td>
                                    <td>' . ($lateTime["checktype"] == 0 ? 'Masuk' : 'Pulang') . '</td>
                                    <td>' . $lateTime["interval"] . '</td>
                                </tr>';
    }
    $html .= '<tr> 
			<th colspan="3" align="center"> Total Keterlambatan Perbulan </th>
			<td> ' . $totalLateTime["totalPerbulan"] . ' </td>	
		</tr>';
    $html .= '<tr> 
		<th colspan="3" align="center"> Total Keterlambatan Pertahun </th>
		<td> ' . $total["totalPertahun"] .  ' Detik </td>	
	</tr>';
    $html .= '</table> 
		<br>';
    $html .= '
		<h2> Table Ketidak Hadiran </h2>
		<table class="table1">
		<tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>Keterangan</th>
		</tr>';

    $i = 1;
    foreach ($perbaikanAbsen as $perbaikanAbsen) {
      $html .= '<tr> 
					<td> ' .  $i++ . '</td>
					<td> ' . $perbaikanAbsen["tanggal"] .  '</td>
					<td> ' . $perbaikanAbsen["keterangan"] .  '</td>
				</tr> ';
    }

    $html .= '</table>
                     </div>
                     <hr> 
                      <div class="section-footer">
                 <div class="left">
                     <p>(Nama)</p>
                     <p>(NIP)</p>
                 </div>
                 <div class="right">
                    <p>(Nama)</p>
                    <p>(NIP)</p>
                 </div>
             </div>
                </div>
        </div>
        </body>
        </html>';
    $mpdf->WriteHTML($html);
    $mpdf->Output('Rekap Absensi - ' . $userid . ".pdf", \Mpdf\Output\Destination::DOWNLOAD);
  }
}
