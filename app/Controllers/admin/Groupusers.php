<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\GroupusersModel;
use App\Models\Admin\SeksibagianModel;

class Groupusers extends BaseController
{
	protected $seksiBagianModel;
	protected $groupUserModel;

	public function __construct()
	{
		$this->seksiBagianModel = new SeksibagianModel();
		$this->groupUserModel = new GroupusersModel();
	}

	public function index()
	{
		$data = [
			'title' => 'PJLP | Group Users',
			'seksi' =>  $this->seksiBagianModel->findAll(),
			'groupUser' => $this->groupUserModel->join('userinfo', 'userinfo.userid = group_user.userid_group')->join('seksibagian', 'id_seksi = seksi_id')->paginate(10),
			'pager' => $this->groupUserModel->pager
		];

		return view('admin/group', $data);
	}

	public function getGroupUser()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id_user_group');

			$user = $this->groupUserModel->getGroupUser($id);

			return json_encode($user);
		}
	}

	public function deleteGroup()
	{
		if ($this->request->isAjax()) {
			$id = $this->request->getVar('id_user_group');

			$this->groupUserModel->delete($id);

			$messeage = [
				'success' => 'Data Group Users Berhasil dihapus!'
			];

			return json_encode($messeage);
		}
	}

	public function Filter()
	{
		if ($this->request->isAJAX()) {

			$filter = $this->request->getVar("filter");
			if ($filter) {
				$groupUser = $this->groupUserModel->filter($filter);
			} else {
				$groupUser = $this->groupUserModel->join('userinfo', 'userinfo.userid = group_user.userid_group')->join('seksibagian', 'id_seksi = seksi_id')->paginate(10);
			}

			return json_encode($groupUser);
		}
	}
}
