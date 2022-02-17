<?php

namespace App\Models\Users;

use CodeIgniter\Model;

class LatetimeModel extends Model
{
	protected $table                = 'latetime';
	protected $primaryKey           = 'lateTime_id';
	protected $useAutoIncrement     = true;
	protected $allowedFields        = ["idlatetime", "useridLatetime", "tanggal", "interval"];
	protected $useTimestamps        = true;

	public function getIdLateTimeWithJoin($id)
	{
		return $this->db->table($this->table)
			->where(["idlatetime" => $id])
			->join('checkinout', 'id = idlatetime')
			->get()->getRowArray();
	}

	public function getDataAbsen($userid, $bulan)
	{
		return $this->db->table($this->table)
			->where(["useridLatetime" => $userid])
			->where(["tanggal" => $bulan])
			->join('checkinout', 'id = idlatetime')
			->get()->getResultArray();
	}

	public function getUsersWithDateTime($userid, $bulan, $tahun)
	{
		return $this->table($this->table)
			->where(["useridLatetime" => $userid])
			->where("Month(tanggal)", $bulan)
			->where("YEAR(tanggal)", $tahun)
			->orderBy("tanggal DESC")
			->join('checkinout', 'id = idlatetime');
	}

	public function getTotalTime($userid, $bulan, $tahun)
	{
		return $this->db->table($this->table)
			->select("SEC_TO_TIME(SUM(TIME_TO_SEC(`interval`))) AS totalPerbulan")
			// ->select("TIME_TO_SEC(SUM(`interval`)) AS totalPerbulan")
			->where(["useridLatetime" => $userid])
			->where("MONTH(tanggal)", $bulan)
			->where("YEAR(tanggal)", $tahun)
			->get()->getRowArray();
	}


	public function getTotalLateTime($userid, $tahun)
	{
		return $this->db->table($this->table)
			->select("SUM(TIME_TO_SEC(`interval`)) AS totalPertahun")
			->where(["useridLatetime" => $userid])
			->where("YEAR(tanggal)", $tahun)
			->get()->getRowArray();
	}
}
