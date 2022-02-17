<?php

namespace App\Models\users;

use CodeIgniter\Model;

class AbsensiModel extends Model
{

    protected $table = "checkinout";
    protected $allowedFields = ["userid", "checktime", "checktype", "verifycode", "SN", "sensorid"];
    protected $primaryKey = "id";
    protected $useTimestamps = true;

    public function getRowAbsensiNoDate($userid)
    {
        return $this->db->table($this->table)
            ->where(["userid" => $userid])
            ->orderBy("checktime DESC")
            ->get()->getRowArray();
    }

    public function getResultAbsensi($userid, $checktime = null)
    {
        if ($checktime == null) {
            return $this->db->table($this->table)
                ->where(["userid" => $userid])
                ->orderBy("checktime DESC")
                ->get()->getResultArray();
        } else {
            $builder = $this->db->table($this->table);
            $builder->where(["userid" => $userid]);
            $builder->where(["checktime" => $checktime]);
            $builder->orderBy("checktime DESC");
            // $builder->join("status", "id_status = status_id");
            $query = $builder->get()->getResultArray();

            return $query;
        }
    }

    public function getResultWithDateTime($userid, $checktime)
    {
        return $this->db->table($this->table)
            ->where(["userid" => $userid])
            ->where("DATE(checktime)", $checktime)
            ->orderBy("checktime DESC")
            ->get()->getResultArray();
    }

    public function getRowDataAbsensi($userid, $tanggal)
    {
        return $this->db->table($this->table)
            ->where(["userid" => $userid])
            ->where("DATE(checktime)", $tanggal)
            ->orderBy("checktime DESC")
            ->get()->getRowArray();
    }
}
