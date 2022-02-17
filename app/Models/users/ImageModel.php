<?php

namespace App\Models\Users;

use CodeIgniter\Model;

class ImageModel extends Model
{
	protected $table = 'image';
	protected $allowedFields = ["userid_image", "image"];
	protected $primaryKey = "id_image";
	protected $useTimestamps = true;
}
