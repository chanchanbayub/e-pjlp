<?php

namespace App\Models\Users;

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

	public function getPerbaikanWithMonth($userid, $bulan, $tahun)
	{
		return $this->table($this->table)
			->where(["perbaikanabsen.userid" => $userid])
			->join('jadwal', 'jadwal.id_jadwal = perbaikanabsen.jadwal_id')
			->where('MONTH(jadwal.tanggal_masuk)', $bulan)
			->where('YEAR(jadwal.tanggal_masuk)', $tahun)
			->where(['pengajuanPerbaikan' => null])
			->join("keterangan", "keterangan.id_keterangan = perbaikanabsen.keterangan_id")
			->orderBy("tanggal_masuk DESC");
	}

	public function getPerbaikanWithFilter($userid, $bulan, $tahun)
	{
		return $this->table($this->table)
			->where(["perbaikanabsen.userid" => $userid])
			->join('jadwal', 'id_jadwal = jadwal_id')
			->where('MONTH(jadwal.tanggal_masuk)', $bulan)
			->where('YEAR(jadwal.tanggal_masuk)', $tahun)
			->where(['pengajuanPerbaikan' => null])
			->join("keterangan", "id_keterangan = keterangan_id")->orderBy("jadwal.tanggal_masuk DESC")
			->get()->getResultArray();
	}

	public function totalPerbaikan($userid, $bulan, $tahun)
	{
		return $this->table($this->table)
			->where(["perbaikanabsen.userid" => $userid])
			->join('jadwal', 'id_jadwal = jadwal_id')
			->where('MONTH(tanggal_masuk)', $bulan)
			->where('YEAR(tanggal_masuk)', $tahun)
			->where(['pengajuanPerbaikan' => null])
			->join("keterangan", "id_keterangan = keterangan_id")
			// ->orderBy("tanggal_masuk DESC")
			->countAllResults();
	}

	public function totalPengajuan($userid, $bulan, $tahun)
	{
		return $this->table($this->table)
			->where(["perbaikanabsen.userid" => $userid])
			->join('jadwal', 'id_jadwal = jadwal_id')
			->where('MONTH(tanggal_masuk)', $bulan)
			->where('YEAR(tanggal_masuk)', $tahun)
			->where(['status' => 0])
			->join("keterangan", "id_keterangan = keterangan_id")
			->countAllResults();
	}
	public function totalSukses($userid, $bulan, $tahun)
	{
		return $this->table($this->table)
			->where(["perbaikanabsen.userid" => $userid])
			->join('jadwal', 'id_jadwal = jadwal_id')
			->where('MONTH(tanggal_masuk)', $bulan)
			->where('YEAR(tanggal_masuk)', $tahun)
			->where(['status' => 1])
			->join("keterangan", "id_keterangan = keterangan_id")->orderBy("tanggal DESC")
			->countAllResults();
	}

	public function perbaikanAbsen()
	{
		return $this->db->table($this->table)
			->where('pengajuanPerbaikan != ',  null)
			->join("keterangan", "id_keterangan = keterangan_id")->orderBy("tanggal DESC")
			->join("userinfo", "userinfo.userid = perbaikanabsen.userid")->orderBy("tanggal DESC")
			->get()->getResultArray();
	}
	public function getTotal()
	{
		return $this->db->table($this->table)
			->where('pengajuanPerbaikan != ',  null)
			->join("keterangan", "id_keterangan = keterangan_id")->orderBy("tanggal DESC")
			->join("userinfo", "userinfo.userid = perbaikanabsen.userid")->orderBy("tanggal DESC")
			->countAllResults();
	}

	public function getId($id)
	{
		return $this->db->table($this->table)
			->where(["id_perbaikan" => $id])
			->join('jadwal', 'id_jadwal = jadwal_id')
			->join("keterangan", "id_keterangan = keterangan_id")
			->get()->getRowArray();
	}

	public function getDataPerbaikan($userid, $bulan, $tahun)
	{
		return $this->db->table($this->table)
			->where(["perbaikanabsen.userid" => $userid])
			->join('jadwal', 'id_jadwal = jadwal_id')
			->where('MONTH(tanggal_masuk)', $bulan)
			->where('YEAR(tanggal_masuk)', $tahun)
			->where('pengajuanPerbaikan != ',  null)
			// ->join("keterangan", "id_keterangan = keterangan_id")->orderBy("tanggal DESC")

			->get()->getResultArray();
	}

	public function getRowPerbaikan($userid, $tanggal)
	{
		return $this->db->table($this->table)
			->where(["perbaikanabsen.userid" => $userid])
			->join('jadwal', 'id_jadwal = jadwal_id')
			->where(["tanggal_masuk" => $tanggal])
			// ->orderBy("tanggal DESC")
			->get()->getRowArray();
	}

	public function getTotalAlfa($userid, $bulan, $tahun)
	{
		return $this->db->table($this->table)
			->where(["perbaikanabsen.userid" => $userid])
			->join('jadwal', 'id_jadwal = jadwal_id')
			->where("MONTH(tanggal_masuk)", $bulan)
			->where("YEAR(tanggal_masuk)", $tahun)
			->where(["keterangan_id" => 1])
			->countAllResults();
	}

	public function getTotalSakit($userid, $bulan, $tahun)
	{
		return $this->db->table($this->table)
			->where(["perbaikanabsen.userid" => $userid])
			->join('jadwal', 'id_jadwal = jadwal_id')
			->where("MONTH(tanggal_masuk)", $bulan)
			->where("YEAR(tanggal_masuk)", $tahun)
			->where(["keterangan_id" => 5])
			->countAllResults();
	}

	public function getTotalIzin($userid, $bulan, $tahun)
	{
		return $this->db->table($this->table)
			->where(["perbaikanabsen.userid" => $userid])
			->join('jadwal', 'id_jadwal = jadwal_id')
			->where("MONTH(tanggal_masuk)", $bulan)
			->where("YEAR(tanggal_masuk)", $tahun)
			->where(["keterangan_id" => 2])
			->countAllResults();
	}
	public function getTotalWFH($userid, $bulan, $tahun)
	{
		return $this->db->table($this->table)
			->where(["perbaikanabsen.userid" => $userid])
			->join('jadwal', 'id_jadwal = jadwal_id')
			->where("MONTH(tanggal_masuk)", $bulan)
			->where("YEAR(tanggal_masuk)", $tahun)
			->where(["keterangan_id" => 3])
			->countAllResults();
	}
	public function getTotalCuti($userid, $bulan, $tahun)
	{
		return $this->db->table($this->table)
			->where(["perbaikanabsen.userid" => $userid])
			->join('jadwal', 'id_jadwal = jadwal_id')
			->where("MONTH(tanggal_masuk)", $bulan)
			->where("YEAR(tanggal_masuk)", $tahun)
			->where(["keterangan_id" => 4])
			->countAllResults();
	}
}
