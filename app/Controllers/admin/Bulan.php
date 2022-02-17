<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\BulanModel;

class Bulan extends BaseController
{
	protected $bulanModel;
	public function __construct()
	{
		$this->bulanModel = new BulanModel();
	}
	public function index()
	{
		$data = [
			'title' => 'PJLP | Data Bulan'
		];
		return view('admin/bulan', $data);
	}

	public function addBulan()
	{
		if ($this->request->isAJAX()) {
			$validation = \Config\Services::validation();
			if (!$this->validate([
				'number_date' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Number Tidak Boleh Kosong'
					]
				],
				'name_bulan' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Nama Bulan Tidak Boleh Kosong'
					]
				],
			])) {
				$messeage = [
					'error' => [
						'number_date' => $validation->getError('number_date'),
						'name_bulan' => $validation->getError('name_bulan')
					]
				];
			} else {
				$number_date =  $this->request->getVar("number_date");
				$name_bulan = $this->request->getVar("name_bulan");

				$this->bulanModel->save([
					'number_date' => $number_date,
					'name_bulan'  => $name_bulan
				]);
				$messeage = [
					'success' => 'Data Berhasil di Tambahkan'
				];
			}
			return json_encode($messeage);
		}
	}
	public function getBulan()
	{
		if ($this->request->isAJAX()) {
			$bulan = $this->bulanModel->findAll();

			return json_encode($bulan);
		}
	}
}
