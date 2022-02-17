<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\BulanModel;
use App\Models\Admin\KeteranganModel;
use App\Models\Admin\PerbaikanabsenModel;
use App\Models\Admin\UserinfoModel;
use DateTime;

class Perbaikanabsen extends BaseController
{
	protected $bulanModel;
	protected $userinfoModel;
	protected $perbaikanAbsenModel;
	protected $keteranganModel;

	public function __construct()
	{
		$this->bulanModel = new BulanModel();
		$this->userinfoModel = new UserinfoModel();
		$this->perbaikanAbsenModel = new PerbaikanabsenModel();
		$this->keteranganModel = new KeteranganModel();
		$date = new DateTime();
		$bulan = $date->format('m');
		$tahun = $date->format('y');
	}
	public function index()
	{
		if (session('level') == 2) {
			$id_seksi = session('id_seksi');
			$perbaikanAbsen = $this->perbaikanAbsenModel->perbaikanAbsen($id_seksi);
			$totalPerbaikan = $this->perbaikanAbsenModel->getTotal($id_seksi);
		} else if (session('level') == 14) {
			$perbaikanAbsen = $this->perbaikanAbsenModel->perbaikanAbsenACC();
			$totalPerbaikan = $this->perbaikanAbsenModel->getTotalAcc();
		}

		$data = [
			'title' => "PJLP Admin | Perbaikan Absen",
			'bulan' => $this->bulanModel->findAll(),
			'perbaikanAbsen' => $perbaikanAbsen,
			'totalPerbaikanAbsen' => $totalPerbaikan,
			// 'anggota' => $this->userinfoModel->getUserInfoById($userid)
			'keterangan' => $this->keteranganModel->findAll()
		];
		return view('admin/dataPerbaikan', $data);
	}

	public function getPerbaikanAbsen()
	{
		if ($this->request->isAJAX()) {
			$id_perbaikan = $this->request->getVar('id_perbaikan');

			$perbaikanAbsen = $this->perbaikanAbsenModel->getId($id_perbaikan);

			return json_encode($perbaikanAbsen);
		}
	}

	public function getDataImage($id_perbaikan)
	{
		$image = $this->perbaikanAbsenModel->getId($id_perbaikan);

		$data = [
			'image' => $image
		];

		return view('admin/image', $data);
	}

	public function update()
	{
		if ($this->request->isAJAX()) {
			$validation = \Config\Services::validation();

			if (!$this->validate([
				'status' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Status Tidak Boleh Kosong!'
					]
				]
			])) {
				$messeage = [
					'error' => [
						'status' => $validation->getError('status')
					]
				];
			} else {
				$id_perbaikan = $this->request->getVar('id_perbaikan');
				$keterangan = $this->request->getVar('keterangan_id');
				$status = $this->request->getVar('status');

				$this->perbaikanAbsenModel->update($id_perbaikan, [
					'id_perbaikan' => $id_perbaikan,
					'keterangan_id' => $keterangan,
					'status' => $status
				]);

				$messeage = [
					'success' => 'Data Berhasil diubah!'
				];
			}

			return json_encode($messeage);
		}
	}
}
