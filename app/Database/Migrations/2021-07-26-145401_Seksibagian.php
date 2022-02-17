<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Seksibagian extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'id_seksi' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'seksi_bagian' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null'	=> false,
			],
			'created_at' => [
				'type'   => "DATETIME",
				'null'	=> true,
			],
			'updated_at' => [
				'type' => "DATETIME",
				'null' => true,
			],
		]);
		$this->forge->addKey('id_seksi', true);
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('seksibagian', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('seksibagian');
	}
}
