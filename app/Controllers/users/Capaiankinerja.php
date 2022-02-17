<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\Admin\BulanModel;
use App\Models\Admin\GajiModel;
use App\Models\users\AbsensiModel;
use App\Models\users\JadwalModel;
use App\Models\users\LatetimeModel;
use App\Models\users\PerbaikanabsenModel;
use DateTime;

class Capaiankinerja extends BaseController
{
	protected $bulanModel;
	protected $jadwalModel;
	protected $absensiModel;
	protected $lateTimeModel;
	protected $gajiModel;
	protected $perbaikanabsenModel;

	public function __construct()
	{
		$this->bulanModel = new BulanModel();
		$this->jadwalModel = new JadwalModel();
		$this->absensiModel = new AbsensiModel();
		$this->gajiModel = new GajiModel();
		$this->lateTimeModel = new LatetimeModel();
		$this->perbaikanabsenModel = new PerbaikanabsenModel();
	}

	public function index()
	{
		$data = [
			'title' => "PJLP | Capaian Kinerja",
			'bulan'	=> $this->bulanModel->findAll(),
		];

		return view("users/capaianKinerja", $data);
	}

	public function getAbsensiDataJadwal($userid)
	{
		if ($this->request->isAJAX()) {
			$filter = $this->request->getVar("filter");
			$dateTime = new DateTime();
			$now = $dateTime->format("Y-m-d");
			$tahun = $dateTime->format("Y");
			$bulan = $dateTime->format("m");

			if ($filter) {
				// Jadwal Data
				$jadwalData = $this->jadwalModel->getJadwalById($userid, $filter, $tahun);

				$jumlahJadwal = $this->jadwalModel->getJumlahJadwalPerbulan($userid, $filter, $tahun);
				// Total Terlambat Perbulan Absensi
				$totalPerbulan = $this->lateTimeModel->getTotalTime($userid, $filter, $tahun);
				// LateTime
				$lateTime = $this->lateTimeModel->getUsersWithDateTime($userid, $filter, $tahun);
				// gaji perbulan 
				$gaji = $this->gajiModel->getGajiWithMonth($userid, $filter, $tahun);
				// total Terlambat Pertahun 
				$totalPertahun = $this->lateTimeModel->getTotalLateTime($userid, $tahun);
				// perbaikan Absen
				$perbaikanAbsen = $this->perbaikanabsenModel->getPerbaikanWithFilter($userid, $filter, $tahun);
				// getTotal Alfa
				$getTotalAlfa = $this->perbaikanabsenModel->getTotalAlfa($userid, $filter, $tahun);

				$getTotalSakit = $this->perbaikanabsenModel->getTotalSakit($userid, $filter, $tahun);

				$getTotalIzin = $this->perbaikanabsenModel->getTotalIzin($userid, $filter, $tahun);

				$getTotalWFH = $this->perbaikanabsenModel->getTotalWFH($userid, $filter, $tahun);

				$getTotalCuti = $this->perbaikanabsenModel->getTotalCuti($userid, $filter, $tahun);
			} else {
				$jadwalData = $this->jadwalModel->getJadwalById($userid, $bulan, $tahun);

				$jumlahJadwal = $this->jadwalModel->getJumlahJadwalPerbulan($userid, $bulan, $tahun);

				$totalPerbulan = $this->lateTimeModel->getTotalTime($userid, $bulan, $tahun);

				$gaji = $this->gajiModel->getGajiWithMonth($userid, $bulan, $tahun);

				$lateTime = $this->lateTimeModel->getUsersWithDateTime($userid, $bulan, $tahun);

				$totalPertahun = $this->lateTimeModel->getTotalLateTime($userid, $tahun);

				$perbaikanAbsen = $this->perbaikanabsenModel->getPerbaikanWithFilter($userid, $bulan, $tahun);

				$getTotalAlfa = $this->perbaikanabsenModel->getTotalAlfa($userid, $bulan, $tahun);

				$getTotalSakit = $this->perbaikanabsenModel->getTotalSakit($userid, $bulan, $tahun);

				$getTotalIzin = $this->perbaikanabsenModel->getTotalIzin($userid, $bulan, $tahun);

				$getTotalWFH = $this->perbaikanabsenModel->getTotalWFH($userid, $bulan, $tahun);

				$getTotalCuti = $this->perbaikanabsenModel->getTotalCuti($userid, $bulan, $tahun);
			}

			$nilaBobotAbsensi = ROUND((((300 * 22) - (($getTotalIzin * 300) + ($getTotalSakit * 300) + ($getTotalAlfa * 600) + $getTotalCuti + $getTotalWFH)) / (300 * 22)) * 100.0);
			$potongan = 60 * 60 * 8;
			if ($totalPertahun["totalPertahun"] >= $potongan || $nilaBobotAbsensi < 50) {
				$this->gajiModel->update($gaji["id_gaji"], [
					'potongan' => "200000"
				]);
			} else if ($totalPertahun["totalPertahun"] < $potongan || $nilaBobotAbsensi >= 50) {
				$this->gajiModel->update($gaji["id_gaji"], [
					'potongan' => "0"
				]);
			}

			// Cek Ketidakhadiran

			foreach ($jadwalData as $rows) :
				$rowAbsen = $this->absensiModel->getRowDataAbsensi($rows["userid"], $rows["tanggal_masuk"]);
				$waktu = $rowAbsen["checktime"];
				$time = explode(" ", $waktu);
				$tanggal = $time[0];

				if ($rows["tanggal_masuk"] != $tanggal) {
					if ($now > $rows["tanggal_masuk"]) {
						$getPerbaikan = $this->perbaikanabsenModel->getRowPerbaikan($userid, $rows["tanggal_masuk"]);
						if ($rows["userid"] != $getPerbaikan["userid"] && $rows["tanggal_masuk"] != $getPerbaikan["tanggal"]) {
							$this->perbaikanabsenModel->save([
								'userid' => $rows["userid"],
								'jadwal_id' => $rows["id_jadwal"],
								'keterangan_id' => 1
							]);
						}
					}
				}

			endforeach;

			$data = [
				'lateTime' => $lateTime,
				'totalPerbulan' =>  $totalPerbulan,
				'totalPertahun' =>  $totalPertahun,
				'gaji' => $gaji,
				'perbaikanAbsen' => $perbaikanAbsen,
				'totalAlfa' => $getTotalAlfa,
				'totalSakit' => $getTotalSakit,
				'totalIzin' => $getTotalIzin,
				'totalWFH' => $getTotalWFH,
				'totalCuti' => $getTotalCuti,
				'jumlahJadwal' => $jumlahJadwal,
				'nilaiBobot' => $nilaBobotAbsensi,
			];
			return json_encode($data);
		}
	}
}
