<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class GajiModel extends Model
{
	protected $table = "gaji";
	protected $useTimestamps = true;
	protected $primaryKey   = 'id_gaji';
	protected $createdField = "created_at";
	protected $updatedField = "updated_at";
	protected $allowedFields = ["userid", "gaji", "tunjangan", "periode_awal", "periode_akhir", "potongan"];

	public function getDataGaji($userid)
	{
		return $this->db->table($this->table)
			->where(["userid" => $userid])
			->get()->getRowArray();
	}
	public function getGajiWithMonth($userid, $bulan, $tahun)
	{
		return $this->db->table($this->table)
			->where(["userid" => $userid])
			->where("MONTH(periode_awal)", $bulan)
			->where("YEAR(periode_awal)", $tahun)
			->get()->getRowArray();
	}

	public function getResultArrayGaji($userid, $bulan, $tahun)
	{
		return $this->db->table($this->table)
			->where(["userid" => $userid])
			->where("MONTH(periode_awal)", $bulan)
			->where("YEAR(periode_awal)", $tahun)
			->orderBy('periode_awal DESC')
			->get()->getResultArray();
	}

	public function getRowGaji($id_gaji)
	{
		return $this->db->table($this->table)
			->where(["id_gaji" => $id_gaji])
			->get()->getRowArray();
	}
}
