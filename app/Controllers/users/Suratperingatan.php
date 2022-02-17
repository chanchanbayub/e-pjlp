<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\Admin\BulanModel;
use App\Models\Users\SuratperingatanModel;

class Suratperingatan extends BaseController
{
	protected $bulanModel;
	protected $suratPeringatanModel;

	public function __construct()
	{
		$this->bulanModel = new BulanModel();
		$this->suratPeringatanModel = new SuratperingatanModel();
	}
	public function index($userid)
	{
		$currentPage = $this->request->getVar("page") ? $this->request->getVar('page') : 1;
		$data = [
			'title' => 'PJLP | Surat Peringatan',
			'bulan' => $this->bulanModel->findAll(),
			'suratPeringatan' => $this->suratPeringatanModel->getSuratPeringatan($userid)->paginate(10, 'peringatan'),
			'pager' => $this->suratPeringatanModel->pager,
			'totalSP' => $this->suratPeringatanModel->where(["userid" => $userid])->countAllResults(),
			'currentPage' => $currentPage
		];
		return view('users/suratPeringatan', $data);
	}
}
