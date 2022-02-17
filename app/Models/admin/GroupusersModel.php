<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class GroupusersModel extends Model
{
	protected $table = "group_user";
	protected $useTimestamps = true;
	protected $primaryKey   = 'id_user_group';
	protected $createdField = "created_at";
	protected $updatedField = "updated_at";
	protected $allowedFields = ["userid_group", "seksi_id"];

	public function getGroupUser($id)
	{
		return $this->db->table($this->table)
			->where(["id_user_group" => $id])
			->get()->getRowArray();
	}

	public function filter($seksi_id)
	{
		return $this->db->table($this->table)
			->where(["seksi_id" => $seksi_id])
			->join('userinfo', 'userinfo.userid = group_user.userid_group')
			->join('seksibagian', 'id_seksi = seksi_id')
			->get()->getResultArray();
	}

	public function getGroupUserid($userid)
	{
		return $this->db->table($this->table)
			->where(["userid_group" => $userid])
			->join('seksibagian', 'id_seksi = seksi_id')
			->get()->getRowArray();
	}
	public function getUserWithSeksi($userid, $id_seksi = null)
	{
		if ($id_seksi == null) {
			return $this->table($this->table)
				->where(["userid_group !=" => $userid])
				->join("seksibagian", "seksibagian.id_seksi = group_user.seksi_id", "left")
				->join("image", "userid_image = userid_group", "left")
				->join('userinfo', 'userid = userid_group', 'left')
				->where(["Privilege" => 0]);
		} else {
			return $this->table($this->table)
				->where(["userid_group !=" => $userid])
				->join("seksibagian", "seksibagian.id_seksi = group_user.seksi_id", "left")
				->join("image", "userid_image = userid_group", "left")
				->join('userinfo', 'userid = userid_group', 'left')
				->where(["seksi_id" => $id_seksi])
				->where(["Privilege" => 0]);
		}
	}
}
