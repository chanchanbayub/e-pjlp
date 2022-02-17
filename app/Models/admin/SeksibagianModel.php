<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class SeksibagianModel extends Model
{
	protected $table = "seksibagian";
	protected $useTimestamps = true;
	protected $primaryKey   = 'id_seksi';
	protected $createdField = "created_at";
	protected $updatedField = "updated_at";
	protected $allowedFields = ["userid", "seksi_bagian"];

	public function getResultSeksi()
	{
		return $this->db->table($this->table)
			->orderBy('id_seksi DESC')
			->get()->getResultArray();
	}

	public function getRowSeksiWithId($id_seksi)
	{
		return $this->db->table($this->table)
			->where(["id_seksi" => $id_seksi])
			->orderBy('id_seksi DESC')
			->get()->getRowArray();
	}
}
