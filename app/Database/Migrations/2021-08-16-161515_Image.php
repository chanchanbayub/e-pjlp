<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Image extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_image' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'userid_image' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => false
			],
			'image'       => [
				'type'       => 'VARCHAR',
				'constraint'  => 255,
				'null'		=> false,
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
		$this->forge->addKey('id_image', true);
		$this->forge->addForeignKey('userid_image', 'userinfo', 'userid', 'CASCADE', 'CASCADE');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('image', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('image');
	}
}
