<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rolemanagement extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_role' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => false,
			],
			'role_name' => [
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
		$this->forge->addKey('id_role', true);
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('rolemanagement', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable("rolemanagement");
	}
}
