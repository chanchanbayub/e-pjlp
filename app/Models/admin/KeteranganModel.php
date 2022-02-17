<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KeteranganModel extends Model
{
	protected $table                = 'keterangan';
	protected $primaryKey           = 'id_keterangan';
	protected $useAutoIncrement     = true;
	protected $allowedFields        = ['keterangan'];

	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
}
