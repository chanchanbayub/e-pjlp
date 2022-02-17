<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class BidangModel extends Model
{
    protected $table = "bidang";
    protected $useTimestamps = true;
    protected $primaryKey   = 'id_bidang';
    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $allowedFields = ["bidang_name", "kepala_bidang", "nip"];
}
