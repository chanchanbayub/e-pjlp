<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Shift extends Migration
{
	public function up()
	{
		$this->forge->addField([

			'id_shift'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'shift_name'       => [
				'type'       => 'VARCHAR',
				'constraint' => 255,
				'null'		 => true,
			],
			'shift_masuk'		 => [
				'type'		 => 'time',
				'null'		 => true
			],
			'shift_pulang'	 => [
				'type'		 => 'time',
				'null'		 => true
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
		$this->forge->addKey('id_shift', true);
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('shift', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('shift');
	}
}
