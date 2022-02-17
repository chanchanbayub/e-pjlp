<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\BulanModel;
use App\Models\Admin\GajiModel;
use App\Models\Admin\UserinfoModel;
use DateTime;

class Gaji extends BaseController
{
	protected $gajiModel;
	protected $bulanModel;
	protected $userinfoModel;

	public function __construct()
	{
		$this->gajiModel = new GajiModel();
		$this->bulanModel = new BulanModel();
		$this->userinfoModel = new UserinfoModel();
	}

	public function index($userid)
	{
		$data = [
			'title' => 'PJLP Admin | Gaji Anggota PJLP',
			'bulan' => $this->bulanModel->findAll(),
			'anggota' => $this->userinfoModel->getUserInfoById($userid),
		];
		return view('admin/gaji', $data);
	}

	public function getGaji($userid)
	{
		if ($this->request->isAJAX()) {
			$date = new DateTime();
			$bulan = $date->format('m');
			$tahun = $date->format('Y');

			$filter = $this->request->getVar('filter');

			if ($filter) {
				$gaji = $this->gajiModel->getResultArrayGaji($userid, $filter, $tahun);
			} else {
				$gaji = $this->gajiModel->getResultArrayGaji($userid, $bulan, $tahun);
			}

			return json_encode($gaji);
		}
	}

	public function addGaji()
	{
		if ($this->request->isAJAX()) {

			$validation = \Config\Services::validation();
			if (!$this->validate([
				'gaji' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Gaji Tidak Boleh Kosong'
					]
				],
				'tunjangan' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Tunjangan Tidak Boleh Kosong'
					]
				],
				'periode_awal' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Tanggal Periode Awal Tidak Boleh Kosong'
					]
				],
				'periode_akhir' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Tanggal Periode Akhir Tidak Boleh Kosong'
					]
				],
			])) {
				$messeage = [
					'error' => [
						'gaji' => $validation->getError('gaji'),
						'tunjangan' => $validation->getError('tunjangan'),
						'periode_awal' => $validation->getError('periode_awal'),
						'periode_akhir' => $validation->getError('periode_akhir'),
					]
				];
			} else {
				$userid = $this->request->getVar("userid");
				$gaji = $this->request->getVar("gaji");
				$tunjangan = $this->request->getVar("tunjangan");
				$periode_awal = $this->request->getVar("periode_awal");
				$periode_akhir = $this->request->getVar("periode_akhir");

				$this->gajiModel->save([
					'userid' => $userid,
					'gaji'		=> $gaji,
					'tunjangan'	=> $tunjangan,
					'periode_awal'	=> $periode_awal,
					'periode_akhir' => $periode_akhir
				]);

				$messeage = [
					'success' => 'Data Berhasil ditambahkan!'
				];
			}
			return json_encode($messeage);
		}
	}

	public function delete()
	{
		if ($this->request->isAJAX()) {
			$id_gaji = $this->request->getVar('id_gaji');

			$gaji = $this->gajiModel->delete($id_gaji);

			$messeage = [
				'success' => 'Data Berhasi dihapus'
			];

			return json_encode($messeage);
		}
	}

	public function edit()
	{
		if ($this->request->isAJAX()) {
			$id_gaji = $this->request->getVar('id_gaji');

			$data = $this->gajiModel->getRowGaji($id_gaji);

			return json_encode($data);
		}
	}

	public function update()
	{
		if ($this->request->isAJAX()) {

			$validation = \Config\Services::validation();
			if (!$this->validate([
				'gaji' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Gaji Tidak Boleh Kosong'
					]
				],
				'tunjangan' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Tunjangan Tidak Boleh Kosong'
					]
				],
				'periode_awal' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Tanggal Periode Awal Tidak Boleh Kosong'
					]
				],
				'periode_akhir' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Tanggal Periode Akhir Tidak Boleh Kosong'
					]
				],
			])) {
				$messeage = [
					'error' => [
						'gaji' => $validation->getError('gaji'),
						'tunjangan' => $validation->getError('tunjangan'),
						'periode_awal' => $validation->getError('periode_awal'),
						'periode_akhir' => $validation->getError('periode_akhir'),
					]
				];
			} else {
				$id_gaji = $this->request->getVar("id_gaji");
				$userid = $this->request->getVar("userid");
				$gaji = $this->request->getVar("gaji");
				$tunjangan = $this->request->getVar("tunjangan");
				$periode_awal = $this->request->getVar("periode_awal");
				$periode_akhir = $this->request->getVar("periode_akhir");

				$this->gajiModel->update($id_gaji, [
					'id_gaji' => $id_gaji,
					'userid' => $userid,
					'gaji'		=> $gaji,
					'tunjangan'	=> $tunjangan,
					'periode_awal'	=> $periode_awal,
					'periode_akhir' => $periode_akhir
				]);

				$messeage = [
					'success' => 'Data Berhasil diedit!'
				];
			}
			return json_encode($messeage);
		}
	}
}
