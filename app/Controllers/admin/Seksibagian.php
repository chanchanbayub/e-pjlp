<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\SeksibagianModel;

class Seksibagian extends BaseController
{
	protected $seksiBagianModel;

	public function __construct()
	{
		$this->seksiBagianModel = new SeksibagianModel();
	}
	public function index()
	{
		$data = [
			'title' => 'PJLP | SEKSI BAGIAN',
			'total' => $this->seksiBagianModel->countAllResults()
		];

		return view('admin/seksibagian', $data);
	}

	public function getDataSeksi()
	{
		if ($this->request->isAJAX()) {
			$seksi = $this->seksiBagianModel->getResultSeksi();

			return json_encode($seksi);
		}
	}

	public function addSeksi()
	{
		if ($this->request->isAJAX()) {
			$validation = \Config\Services::validation();
			if (!$this->validate([
				'seksi_bagian' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Nama Seksi Tidak Boleh Kosong'
					]
				]
			])) {
				$messeage = [
					'error' => [
						'seksi_bagian' => $validation->getError('seksi_bagian')
					]
				];
			} else {
				$seksi = $this->request->getVAR('seksi_bagian');

				$this->seksiBagianModel->save([
					'seksi_bagian' => $seksi
				]);

				$messeage = [
					'success' => 'Data Seksi Baru Berhasil ditambahkan!'
				];
			}
			return json_encode($messeage);
		}
	}

	public function getRowSeksi()
	{
		if ($this->request->isAJAX()) {
			$id_seksi = $this->request->getVar('id_seksi');

			$rowSeksi = $this->seksiBagianModel->getRowSeksiWithId($id_seksi);

			return json_encode($rowSeksi);
		}
	}

	public function updateSeksi()
	{
		if ($this->request->isAJAX()) {
			$validation = \Config\Services::validation();
			if (!$this->validate([
				'seksi_bagian' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Nama Seksi Tidak Boleh Kosong'
					]
				]
			])) {
				$messeage = [
					'error' => [
						'seksi_bagian' => $validation->getError('seksi_bagian')
					]
				];
			} else {
				$id_seksi = $this->request->getVar('id_seksi');
				$seksi = $this->request->getVAR('seksi_bagian');

				$this->seksiBagianModel->update($id_seksi, [
					'id_seksi' => $id_seksi,
					'seksi_bagian' => $seksi
				]);

				$messeage = [
					'success' => 'Data Seksi Berhasil diubah!'
				];
			}
			return json_encode($messeage);
		}
	}
	public function deleteSeksi()
	{
		if ($this->request->isAJAX()) {
			$id_seksi = $this->request->getVar('id_seksi');

			$this->seksiBagianModel->delete($id_seksi);

			$messeage = [
				'success' => 'Data Seksi Berhasil dihapus!'
			];

			return json_encode($messeage);
		}
	}
}
