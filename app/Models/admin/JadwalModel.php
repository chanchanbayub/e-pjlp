<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = "jadwal";
    protected $useTimestamps = true;
    protected $primaryKey   = 'id_jadwal';
    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $allowedFields = ["userid", "tanggal_masuk", "tanggal_pulang", "shift_id"];

    public function getJadwalDataById($id)
    {
        $data = $this->db->table($this->table)
            ->where(['userid' => $id])
            ->join('shift', 'shift_id = id_shift')
            ->orderBy('id_jadwal', 'DESC')
            ->get()->getResultArray();
        return $data;
    }

    public function getJadwalById($userid, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->where(["userid" => $userid])
            ->where("MONTH(tanggal_masuk)", $bulan)
            ->where("Year(tanggal_masuk)", $tahun)
            ->join("shift", " id_shift = shift_id")->orderBy("tanggal_masuk DESC");
    }

    public function getJadwalByFilter($userid, $bulan, $tahun)
    {
        return $this->db->table($this->table)
            ->where(["userid" => $userid])
            ->where("MONTH(tanggal_masuk)", $bulan)
            ->where("Year(tanggal_masuk)", $tahun)
            ->join("shift", " id_shift = shift_id")->orderBy("tanggal_masuk DESC")
            ->get()->getResultArray();
    }

    public function getRowJadwal($id_jadwal)
    {
        return $this->db->table($this->table)
            ->where(['id_jadwal' => $id_jadwal])
            ->join('shift', 'shift_id = id_shift')
            ->orderBy('id_jadwal', 'DESC')
            ->get()->getRowArray();
    }
}
