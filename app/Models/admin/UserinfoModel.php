<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UserinfoModel extends Model
{
	protected $table                = "userinfo";
	protected $primaryKey           = "userid";
	protected $allowedFields = ["userid", "badgenumber", "defaultdepid", "name", "Password", "Privilege", "Gender", "Birthday", "
	SN"];

	public function getUserInfoById($userid)
	{
		return $this->db->table($this->table)
			->where(["userid" => $userid])
			->join("group_user", "group_user.userid_group = userinfo.userid", "left")
			->join("seksibagian", "seksibagian.id_seksi = group_user.seksi_id", "left")
			->join("image", "userid_image = userid", "left")
			// ->where(["Privilege" => 0])
			->get()->getRowArray();
	}

	public function getUserInfoPrivilege()
	{
		return $this->db->table($this->table)
			->where(["Privilege" => 0])
			->get()->getResultArray();
	}

	public function getDataUser($userid)
	{
		return $this->db->table($this->table)
			->where(["userid" => $userid])
			->join("group_user", "group_user.userid_group = userinfo.userid", "left")
			->join("seksibagian", "seksibagian.id_seksi = group_user.seksi_id", "left")
			->join("image", "userid_image = userid", "left")
			->get()->getRowArray();
	}
}
