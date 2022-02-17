<?php

namespace App\Models\users;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    protected $table = "kegiatan";
    protected $useTimestamps = true;
    protected $primaryKey   = 'kegiatan_id';
    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $allowedFields = ["userid", "kegiatan", "tanggal", "jam", "selesai", "status", "bobot"];

    public function getDataKegiatan($userid, $bulan, $tahun)
    {
        return $this->table($this->table)->where(["userid" => $userid])->where("MONTH(tanggal)", $bulan)->where("YEAR(tanggal)", $tahun);
    }
    public function getJumlahKinerja($userid, $bulan, $tahun)
    {
        return $this->db->table($this->table)
            ->where(['userid' => $userid])
            ->where('MONTH(tanggal)', $bulan)
            ->where('YEAR(tanggal)', $tahun)
            ->countAllResults();
    }

    public function getKinerjaPdf($userid, $bulan, $tahun)
    {
        return $this->db->table($this->table)
            ->where(["userid" => $userid])
            ->where("MONTH(tanggal)", $bulan)
            ->where("YEAR(tanggal)", $tahun)
            ->get()->getResultArray();
    }
}
