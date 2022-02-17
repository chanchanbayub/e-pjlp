<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usermanagement extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_user' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null'	=> false,
			],
			'nip' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => false,
			],
			'role_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'null' => false,
			],
			'seksi_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'null' => false,
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
		$this->forge->addKey('id_user', true);
		$this->forge->addForeignKey('role_id', 'rolemanagement', 'id_role', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('seksi_id', 'seksibagian', 'id_seksi', 'CASCADE', 'CASCADE');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('usermanagement', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('usermanagement');
	}
}
