<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PerbaikanabsenModel extends Model
{
	protected $table                = 'perbaikanabsen';
	protected $primaryKey           = 'id_perbaikan';
	protected $useAutoIncrement     = true;
	protected $allowedFields        = ['userid', 'jadwal_id', 'keterangan_id', 'pengajuanPerbaikan', 'status', 'file'];

	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';

	// public function getPerbaikanWithMonth($userid, $bulan, $tahun)
	// {
	// 	return $this->table($this->table)
	// 		->where(["perbaikanabsen.userid" => $userid])
	// 		->join('jadwal', 'jadwal_id = id_jadwal')
	// 		->where('MONTH(tanggal_masuk)', $bulan)
	// 		->where('YEAR(tanggal_masuk)', $tahun)
	// 		->where(['pengajuanPerbaikan' => null])
	// 		->join("keterangan", "id_keterangan = keterangan_id")->orderBy("tanggal_masuk DESC");
	// }

	// public function getPerbaikanWithFilter($userid, $bulan, $tahun)
	// {
	// 	return $this->table($this->table)
	// 		->where(["perbaikanabsen.userid" => $userid])
	// 		->join('jadwal', 'jadwal_id = id_jadwal')
	// 		->where('MONTH(tanggal_masuk)', $bulan)
	// 		->where('YEAR(tanggal_masuk)', $tahun)
	// 		->where(['pengajuanPerbaikan' => null])
	// 		->join("keterangan", "id_keterangan = keterangan_id")->orderBy("tanggal_masuk DESC")
	// 		->get()->getResultArray();
	// }

	// public function totalPerbaikan($userid, $bulan, $tahun)
	// {
	// 	return $this->table($this->table)
	// 		->where(["perbaikanabsen.userid" => $userid])
	// 		->join('jadwal', 'jadwal_id = id_jadwal')
	// 		->where('MONTH(tanggal_masuk)', $bulan)
	// 		->where('YEAR(tanggal_masuk)', $tahun)
	// 		// ->where(['pengajuanPerbaikan' => null])
	// 		->join("keterangan", "id_keterangan = keterangan_id")->orderBy("tanggal_masuk DESC")
	// 		->countAllResults();
	// }

	// public function totalPengajuan($userid, $bulan, $tahun)
	// {
	// 	return $this->table($this->table)
	// 		->where(["perbaikanabsen.userid" => $userid])
	// 		->where('MONTH(tanggal_masuk)', $bulan)
	// 		->where('YEAR(tanggal_masuk)', $tahun)
	// 		->where(['status' => 0])
	// 		->join("keterangan", "id_keterangan = keterangan_id")->orderBy("tanggal_masuk DESC")
	// 		->countAllResults();
	// }
	public function totalSukses($userid, $bulan, $tahun)
	{
		return $this->table($this->table)
			->where(["perbaikanabsen.userid" => $userid])
			->join('jadwal', 'jadwal_id = id_jadwal')
			->where('MONTH(tanggal_jadwal)', $bulan)
			->where('YEAR(tanggal_jadwal)', $tahun)
			->where(['status' => 2])
			->join("keterangan", "id_keterangan = keterangan_id")->orderBy("tanggal_masuk DESC")
			->countAllResults();
	}

	public function perbaikanAbsen($id_seksi)
	{
		return $this->db->table($this->table)
			->where('pengajuanPerbaikan != ',  null)
			->join('jadwal', 'jadwal_id = id_jadwal')
			->join("keterangan", "id_keterangan = keterangan_id")
			->join("userinfo", "userinfo.userid = perbaikanabsen.userid")
			->join('group_user', 'group_user.userid_group = perbaikanabsen.userid')
			->join('seksibagian', 'seksibagian.id_seksi = seksi_id')
			->where(["seksi_id" => $id_seksi])
			->where(["status " => 0])
			->get()->getResultArray();
	}

	public function perbaikanAbsenACC()
	{
		return $this->db->table($this->table)
			->where('pengajuanPerbaikan != ',  null)
			->join('jadwal', 'jadwal_id = id_jadwal')
			->join("keterangan", "id_keterangan = keterangan_id")
			->join("userinfo", "userinfo.userid = perbaikanabsen.userid")
			// ->join('group_user', 'group_user.userid_group = perbaikanabsen.userid')
			// ->join('seksibagian', 'seksibagian.id_seksi = seksi_id')
			// ->where(["seksi_id" => $id_seksi])
			->where(["status" => 1])
			->get()->getResultArray();
	}

	public function getTotalAcc()
	{
		return $this->db->table($this->table)
			->where('pengajuanPerbaikan != ',  null)
			->join('jadwal', 'jadwal_id = id_jadwal')
			->join("keterangan", "id_keterangan = keterangan_id")->orderBy("tanggal_masuk DESC")
			->join("userinfo", "userinfo.userid = perbaikanabsen.userid")->orderBy("tanggal_masuk DESC")
			// ->join('group_user', 'group_user.userid_group = perbaikanabsen.userid')
			// ->join('seksibagian', 'seksibagian.id_seksi = seksi_id')
			// ->where(["seksi_id" => $id_seksi])
			->where(["status" => 1])
			->countAllResults();
	}

	public function getTotal($id_seksi)
	{
		return $this->db->table($this->table)
			->where('pengajuanPerbaikan != ',  null)
			->join('jadwal', 'jadwal_id = id_jadwal')
			->join("keterangan", "id_keterangan = keterangan_id")->orderBy("tanggal_masuk DESC")
			->join("userinfo", "userinfo.userid = perbaikanabsen.userid")->orderBy("tanggal_masuk DESC")
			->join('group_user', 'group_user.userid_group = perbaikanabsen.userid')
			->join('seksibagian', 'seksibagian.id_seksi = seksi_id')
			->where(["seksi_id" => $id_seksi])
			->where(["status" => 0])
			->countAllResults();
	}

	public function getId($id)
	{
		return $this->db->table($this->table)
			->where(["id_perbaikan" => $id])
			->join('jadwal', 'jadwal_id = id_jadwal')
			->join("keterangan", "id_keterangan = keterangan_id")->orderBy("tanggal_masuk DESC")
			->get()->getRowArray();
	}

	public function getDataPerbaikan($userid, $bulan, $tahun)
	{
		return $this->db->table($this->table)
			->where(["perbaikanabsen.userid" => $userid])
			->join('jadwal', 'jadwal_id = id_jadwal')
			->where('MONTH(tanggal_masuk)', $bulan)
			->where('YEAR(tanggal_masuk)', $tahun)
			->where('pengajuanPerbaikan != ',  null)
			->join("keterangan", "id_keterangan = keterangan_id")->orderBy("tanggal_masuk DESC")
			// ->join("keterangan", "id_keterangan = pengajuanPerbaikan")->orderBy("tanggal DESC")
			->get()->getResultArray();
	}

	public function getRowPerbaikan($userid, $tanggal)
	{
		return $this->db->table($this->table)
			->where(["perbaikanabsen.userid" => $userid])
			->where(["tanggal_masuk" => $tanggal])
			// ->orderBy("tanggal DESC")
			->get()->getRowArray();
	}

	public function getTotalAlfa($userid, $bulan, $tahun)
	{
		return $this->db->table($this->table)
			->where(["userid" => $userid])
			->where("MONTH(tanggal)", $bulan)
			->where("YEAR(tanggal)", $tahun)
			->where(["keterangan_id" => 1])
			->countAllResults();
	}

	public function getTotalSakit($userid, $bulan, $tahun)
	{
		return $this->db->table($this->table)
			->where(["userid" => $userid])
			->where("MONTH(tanggal)", $bulan)
			->where("YEAR(tanggal)", $tahun)
			->where(["keterangan_id" => 5])
			->countAllResults();
	}

	public function getTotalIzin($userid, $bulan, $tahun)
	{
		return $this->db->table($this->table)
			->where(["userid" => $userid])
			->where("MONTH(tanggal)", $bulan)
			->where("YEAR(tanggal)", $tahun)
			->where(["keterangan_id" => 2])
			->countAllResults();
	}
	public function getTotalWFH($userid, $bulan, $tahun)
	{
		return $this->db->table($this->table)
			->where(["userid" => $userid])
			->where("MONTH(tanggal)", $bulan)
			->where("YEAR(tanggal)", $tahun)
			->where(["keterangan_id" => 3])
			->countAllResults();
	}
	public function getTotalCuti($userid, $bulan, $tahun)
	{
		return $this->db->table($this->table)
			->where(["userid" => $userid])
			->where("MONTH(tanggal)", $bulan)
			->where("YEAR(tanggal)", $tahun)
			->where(["keterangan_id" => 4])
			->countAllResults();
	}
}
