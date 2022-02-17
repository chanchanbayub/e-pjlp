<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class RolemanagementModel extends Model
{
	protected $table = "rolemanagement";
	protected $useTimestamps = true;
	protected $primaryKey   = 'id';
	protected $createdField = "created_at";
	protected $updatedField = "updated_at";
	protected $allowedFields = ["id_role", "role_name"];

	public function getResultRole()
	{
		return $this->db->table($this->table)
			->orderBy('id_role DESC')
			->get()->getResultArray();
	}
}
