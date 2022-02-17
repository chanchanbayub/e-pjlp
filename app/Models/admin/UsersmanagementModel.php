<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UsersmanagementModel extends Model
{
	protected $table = "userinfo";
	protected $primaryKey   = 'userid';
	protected $allowedFields = ["badgenumber", "defaultdepid", "name", "Password", "Card", "Privilege", "AccGroup", "TimeZones", "Gender", "Birthday", "
	SN", "UTime", "DelTag", "RegisterOT"];

	public function getUsersManagement()
	{
		return $this->db->table($this->table)
			->where(["Privilege !=" => 0])
			->get()->getResultArray();
	}

	public function getTotalUsersManagement()
	{
		return $this->db->table($this->table)
			->where(["Privilege !=" => 0])
			->countAllResults();
	}

	public function getRowUser($userid)
	{
		return $this->db->table($this->table)
			->where(["userid" => $userid])
			->get()->getRowArray();
	}
}
