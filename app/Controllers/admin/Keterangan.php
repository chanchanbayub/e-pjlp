<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KeteranganModel;

class Keterangan extends BaseController
{
	protected $keteranganModel;

	public function __construct()
	{
		$this->keteranganModel = new KeteranganModel();
	}

	public function index()
	{
		$data = [
			'title' => 'PJLP | Keterangan Ketidakhadiran',
			'keterangan' => $this->keteranganModel->orderBy('id_keterangan DESC')->paginate(5),
			'totalKeterangan' => $this->keteranganModel->countAllResults(),
			'pager' => $this->keteranganModel->pager
		];

		return view('admin/keterangan', $data);
	}

	public function addKeterangan()
	{
		if ($this->request->isAJAX()) {
			$validation = \Config\Services::validation();
			if (!$this->validate([
				'keterangan' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Keterangan Tidak Boleh Kosong'
					]
				],
			])) {
				$messeage = [
					'error' => [
						'keterangan' => $validation->getError('keterangan'),
					]
				];
			} else {
				$keterangan = $this->request->getVar("keterangan");

				$this->keteranganModel->save([
					'keterangan' => $keterangan,

				]);

				$messeage = [
					'success' => 'Keterangan Berhasi ditambahkan!'
				];
			}
			return json_encode($messeage);
		}
	}

	public function editKeterangan()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar("id_keterangan");

			$keterangan = $this->keteranganModel->where(['id_keterangan' => $id])->first();

			return json_encode($keterangan);
		}
	}

	public function updateKeterangan()
	{
		if ($this->request->isAJAX()) {
			$id_keterangan = $this->request->getVar("id_keterangan");
			$keterangan = $this->request->getVar("keterangan");

			$this->keteranganModel->update($id_keterangan, [
				'id_keterangan' => $id_keterangan,
				'keterangan'	=> $keterangan,
			]);

			$messeage = [
				'success' => 'Keterangan Berhasil diubah!'
			];

			return json_encode($messeage);
		}
	}

	public function deleteKeterangan()
	{
		if ($this->request->isAJAX()) {
			$id_keterangan = $this->request->getVar('id_keterangan');

			$this->keteranganModel->delete($id_keterangan);

			$messeage = [
				'success' => 'Data Berhasi dihapus'
			];

			return json_encode($messeage);
		}
	}
}
