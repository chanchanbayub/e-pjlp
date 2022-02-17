<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\RolemanagementModel;
use App\Models\Admin\SeksibagianModel;
use App\Models\Admin\UsersmanagementModel;
use DateTime;

class Usersmanagement extends BaseController
{
	protected $roleManagementModel;
	protected $seksiBagianModel;
	protected $usersManagementModel;

	public function __construct()
	{
		$this->roleManagementModel = new RolemanagementModel();
		$this->seksiBagianModel = new SeksibagianModel();
		$this->usersManagementModel = new UsersmanagementModel();
	}
	public function index()
	{
		$users = $this->usersManagementModel->getUsersManagement();

		$data = [
			'title' => 'PJLP | Users Management',
			'role' => $this->roleManagementModel->findAll(),
			'seksi' => $this->seksiBagianModel->findAll(),
			'usersmanagement' => $users,
			'totalUsers' => $this->usersManagementModel->getTotalUsersManagement()
		];

		return view('admin/usersmanagement', $data);
	}

	public function addUsers()
	{
		if ($this->request->isAJAX()) {
			$validation = \Config\Services::validation();
			if (!$this->validate([
				'badgenumber' => [
					'rules' => 'required|is_unique[userinfo.badgenumber]',
					'errors' => [
						'required' => 'ID / NIP Tidak Boleh Kosong',
						'is_unique' => 'ID / NIP Sudah terdaftar'
					]
				],
				'defaultdeptid' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Bidang Tidak Boleh Kosong'
					]
				],
				'name' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Nama Tidak Boleh Kosong'
					]
				],
				'Password' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Password Tidak Boleh Kosong'
					]
				],
				'Privilege' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Role Tidak Boleh Kosong'
					]
				],

			])) {
				$pesan = [
					'error' => [
						'badgenumber' => $validation->getError('badgenumber'),
						'defaultdeptid' => $validation->getError('defaultdeptid'),
						'name' => $validation->getError('name'),
						'Password' => $validation->getError('Password'),
						'Privilege' => $validation->getError('Privilege'),
					]
				];
			} else {
				$tanggal = new DateTime();
				$date =	$tanggal->format("Y-m-d H:i:s");
				$badgenumber = $this->request->getVar('badgenumber');
				$defauldeptid = $this->request->getVar('defaultdeptid');
				$name = $this->request->getVar('name');
				$password = $this->request->getVar('Password');
				$privilege = $this->request->getVar('Privilege');
				$jenis_kelamin = $this->request->getVar('Gender');
				$birthday = $this->request->getVar('Birthday');

				$this->usersManagementModel->save([
					'badgenumber' => $badgenumber,
					'defaultdeptid' => $defauldeptid,
					'name' => $name,
					'Password' => $password,
					'Card' => 0,
					'Privilege' => $privilege,
					'AccGroup' => 1,
					'TimeZones' => "0000000000000000",
					'Gender' => $jenis_kelamin,
					'Birthday' => $birthday,
					'SN' => 6339160200267,
					'UTime' => $date,
					'DelTag' => 0,
					'RegisterOT' => 1
				]);

				$pesan = [
					'success' => 'Users Baru Telah Ditambahkan!'
				];
			}
			return json_encode($pesan);
		}
	}

	public function getUsers()
	{
		if ($this->request->isAJAX()) {
			$id_user = $this->request->getVAR('userid');

			$userData = $this->usersManagementModel->getRowUser($id_user);

			return json_encode($userData);
		}
	}

	public function updateUser()
	{
		if ($this->request->isAJAX()) {
			$tanggal = new DateTime();
			$date =	$tanggal->format("Y-m-d H:i:s");
			$userid = $this->request->getVar('userid');
			$badgenumber = $this->request->getVar('badgenumber');
			$defauldeptid = $this->request->getVar('defaultdeptid');
			$name = $this->request->getVar('name');
			$password = $this->request->getVar('Password');
			$privilege = $this->request->getVar('Privilege');
			$jenis_kelamin = $this->request->getVar('Gender');
			$birthday = $this->request->getVar('Birthday');

			$this->usersManagementModel->update($userid, [
				'userid' => $userid,
				'badgenumber' => $badgenumber,
				'defaultdeptid' => $defauldeptid,
				'name' => $name,
				'Password' => $password,
				'Card' => 0,
				'Privilege' => $privilege,
				'AccGroup' => 1,
				'TimeZones' => "0000000000000000",
				'Gender' => $jenis_kelamin,
				'Birthday' => $birthday,
				'SN' => 6339160200267,
				'UTime' => $date,
				'DelTag' => 0,
				'RegisterOT' => 1
			]);

			$pesan = [
				'success' => ' Data Users Berhasil diubah!'
			];
			return json_encode($pesan);
		}
	}

	public function deleteUser()
	{
		if ($this->request->isAJAX()) {

			$id_user = $this->request->getVar('userid');

			$this->usersManagementModel->delete($id_user);

			$pesan = [
				'success' => 'Data User Berhasil dihapus! '
			];

			return json_encode($pesan);
		}
	}
}
