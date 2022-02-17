<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\SuratperingatanModel;
use App\Models\Admin\UserinfoModel;

class Suratperingatan extends BaseController
{
	protected $suratPeringatanModel;
	protected $userinfoModel;

	public function __construct()
	{
		$this->suratPeringatanModel = new SuratperingatanModel();
		$this->userinfoModel = new UserinfoModel();
	}

	public function index()
	{
		$data = [
			'title' => 'PJLP | Surat Peringatan',
			'suratPeringatan' => $this->suratPeringatanModel->suratPeringatanWithJoin(),
			'totalPeringatan' => $this->suratPeringatanModel->countAllResults(),
			'anggota' => $this->userinfoModel->getUserInfoPrivilege()
		];


		return view('admin/suratperingatan', $data);
	}

	public function addSurat()
	{
		if ($this->request->isAJAX()) {
			$validation = \Config\Services::validation();
			if (!$this->validate([
				'userid' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Nama Tidak Boleh Kosong'
					]
				],
				'tanggal' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Tanggal Tidak Boleh Kosong'
					]
				],
				'pelanggaran' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Pelanggaran Tidak Boleh Kosong'
					]
				]
			])) {
				$messeage = [
					'error' => [
						'userid' => $validation->getError('userid'),
						'tanggal' => $validation->getError('tanggal'),
						'pelanggaran' => $validation->getError('pelanggaran'),
					]
				];
			} else {
				$userid = $this->request->getVar("userid");
				$tanggal = $this->request->getVar("tanggal");
				$pelanggaran = $this->request->getVar("pelanggaran");
				$nilai = $this->request->getVar("nilai");

				$this->suratPeringatanModel->save([
					'userid' => $userid,
					'tanggal' => $tanggal,
					'pelanggaran' => $pelanggaran,
					'nilai' => $nilai,
				]);

				$messeage = [
					'success' => 'Surat Peringatan Berhasi dikirim!'
				];
			}
			return json_encode($messeage);
		}
	}

	public function editSurat()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar("id_peringatan");

			$suratPeringatan = $this->suratPeringatanModel->getSuratPeringatanWithID($id);

			return json_encode($suratPeringatan);
		}
	}

	public function updateSurat()
	{
		if ($this->request->isAJAX()) {
			$id_peringatan = $this->request->getVar("id_peringatan");
			$userid = $this->request->getVar("userid");
			$tanggal = $this->request->getVar("tanggal");
			$pelanggaran = $this->request->getVar("pelanggaran");
			$nilai = $this->request->getVar("nilai");

			$this->suratPeringatanModel->update($id_peringatan, [
				'id_peringatan' => $id_peringatan,
				'userid'	=> $userid,
				'tanggal'	=> $tanggal,
				'pelanggaran' => $pelanggaran,
				'nilai' => $nilai
			]);

			$messeage = [
				'success' => 'Surat Peringatan Berhasil diubah!'
			];

			return json_encode($messeage);
		}
	}

	public function delete()
	{
		if ($this->request->isAJAX()) {
			$id_peringatan = $this->request->getVar('id_peringatan');

			$this->suratPeringatanModel->delete($id_peringatan);


			$messeage = [
				'success' => 'Data Berhasi dihapus'
			];

			return json_encode($messeage);
		}
	}
}
