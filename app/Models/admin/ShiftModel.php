<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ShiftModel extends Model
{
    protected $table = "shift";
    protected $useTimestamps = true;
    protected $primaryKey   = 'id_shift';
    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $allowedFields = ["shift_name", "shift_masuk", "shift_pulang"];

    public function getDataShift($id_shift)
    {
        return $this->db->table($this->table)
            ->where(['id_shift' => $id_shift])
            ->get()->getRowArray();
    }

    public function getResultShift()
    {
        return $this->db->table($this->table)
            ->orderBy('id_shift DESC')
            ->get()->getResultArray();
    }
}
