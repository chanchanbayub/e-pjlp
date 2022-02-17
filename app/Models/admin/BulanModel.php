<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class BulanModel extends Model
{
	protected $table = "bulan";
	protected $useTimestamps = true;
	protected $primaryKey   = 'bulan_id';
	protected $createdField = "created_at";
	protected $updatedField = "updated_at";
	protected $allowedFields = ["number_date", "name_bulan"];
}
