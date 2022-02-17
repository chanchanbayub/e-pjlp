<?php

namespace App\Models\users;

use CodeIgniter\Model;

class JadwalModel extends Model
{

    protected $table = 'jadwal';
    protected $allowedFields = ["userid", "tanggal_masuk", "tangga_pulang", "shift_id"];
    protected $primaryKey = "id_jadwal";
    protected $useTimestamps = true;

    public function getJadwalById($userid, $bulan, $tahun)
    {
        return $this->db->table($this->table)
            ->where(["userid" => $userid])
            ->where("MONTH(tanggal_masuk)", $bulan)
            ->where("Year(tanggal_masuk)", $tahun)
            ->join("shift", " id_shift = shift_id")->orderBy("tanggal_masuk DESC")
            ->get()->getResultArray();
    }

    public function getJadwalByUserid($userid, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->where(["userid" => $userid])
            ->where("MONTH(tanggal_masuk)", $bulan)
            ->where("Year(tanggal_masuk)", $tahun)
            ->join("shift", " id_shift = shift_id")->orderBy("tanggal_masuk DESC");
    }

    public function getJadwal($userid, $tanggal)
    {
        return $this->db->table($this->table)
            ->where(["userid" => $userid])
            ->where(["tanggal_masuk" => $tanggal])
            ->join("shift", "id_shift = shift_id")
            ->get()->getRowArray();
    }

    public function getJumlahJadwalPerbulan($userid, $bulan, $tahun)
    {
        $builder = $this->db->table($this->table);
        $builder->where(["userid" => $userid]);
        $builder->where("MONTH(tanggal_masuk)", $bulan);
        $builder->where("Year(tanggal_masuk)", $tahun);
        // $builder->orLike(["tanggal_masuk", $tanggal]);
        $builder->join("shift", " id_shift = shift_id")->orderBy("tanggal_masuk DESC");
        $data = $builder->countAllResults();
        return $data;
    }
}
