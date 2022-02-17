<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GroupUser extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'id_user_group' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'userid_group'       => [
				'type'       => 'INT',
				'constraint'  => 11,
				'null'		=> false,
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
		$this->forge->addKey('id_user_group', true);
		$this->forge->addForeignKey('userid_group', 'userinfo', 'userid', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('seksi_id', 'seksibagian', 'id_seksi', 'CASCADE', 'CASCADE');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('group_user', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('group_user');
	}
}
