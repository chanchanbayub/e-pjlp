<?php

namespace App\Models\Users;

use CodeIgniter\Model;

class SuratperingatanModel extends Model
{
	protected $table                = 'peringatan';
	protected $primaryKey           = 'id_peringatan';
	protected $useAutoIncrement     = true;
	protected $allowedFields        = ["userid", "tanggal", "pelanggaran", "nilai"];
	protected $useTimestamps        = true;

	public function getSuratPeringatan($userid)
	{
		return $this->table($this->table)
			->where(["userid" => $userid]);
	}
}
