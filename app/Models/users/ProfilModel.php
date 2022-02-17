<?php

namespace App\Models\users;

use CodeIgniter\Model;

class ProfilModel extends Model
{
    protected $table = "userinfo";
    protected $useTimestamps = false;
    protected $primaryKey   = "userid";

    protected $allowedFields = ["name", "Password", "Birthday", "Gender"];

    public function getData($userid)
    {
        return $this->db->table($this->table)
            ->where(["userid" => $userid])
            ->join("group_user", "group_user.userid_group = userinfo.userid", "left")
            ->join("seksibagian", "seksibagian.id_seksi = group_user.seksi_id", "left")
            ->join("image", "userid_image = userid", "left")
            ->get()->getRowArray();
    }
}
