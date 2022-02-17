<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class SuratperingatanModel extends Model
{
	protected $table = "peringatan";
	protected $useTimestamps = true;
	protected $primaryKey   = 'id_peringatan';
	protected $createdField = "created_at";
	protected $updatedField = "updated_at";
	protected $allowedFields = ["userid", "tanggal", "pelanggaran", "nilai"];

	public function suratPeringatanWithJoin()
	{
		return $this->db->table($this->table)
			->join('userinfo', 'userinfo.userid = peringatan.userid')
			->orderBy('id_peringatan DESC')
			->get()->getResultArray();
	}

	public function getSuratPeringatanWithID($id_peringatan)
	{
		return $this->db->table($this->table)
			->where(["id_peringatan" => $id_peringatan])
			->get()->getRowArray();
	}
}
