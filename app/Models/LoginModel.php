<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'userinfo';

    public function getDataLogin($userid)
    {
        return $this->db->table($this->table)
            ->where(["badgenumber" => $userid])
            ->join("image", "userid_image = userid", "left")
            ->join("group_user", "group_user.userid_group = userinfo.userid", "left")
            ->join("seksibagian", "seksibagian.id_seksi = group_user.seksi_id", "left")
            ->get()->getRowArray();
    }
}
