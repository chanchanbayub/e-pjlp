<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bidang extends Migration
{
	public function up()
	{
		$this->forge->addField([

			'id_bidang'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'bidang_name'       => [
				'type'       => 'VARCHAR',
				'constraint' => 255,
				'null'		 => true,
			],
			'kepala_bidang' => [
				'type' => "varchar",
				'constraint' => 255,
				'null' => false,
			],
			'nip' => [
				'type' => "varchar",
				'constraint' => 255,
				'null' => false
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
		$this->forge->addKey('id_bidang', true);
		// $this->forge->addForeignKey("useridBidang", "userinfo", "userid", "CASCADE", "CASCADE");
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('bidang', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('bidang');
	}
}
