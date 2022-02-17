<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peringatan extends Migration
{
	public function up()
	{
		$this->forge->addField([

			'id_peringatan' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'userid' => [
				'type' => 'INT',
				'constraint' => 11,
				'null'	=> false,
			],
			'tanggal' => [
				'type' => 'DATE',
				'null'	=> false,
			],
			'pelanggaran' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => false,
			],
			'nilai' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => true,
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
		$this->forge->addKey('id_peringatan', true);
		$this->forge->addForeignKey('userid', 'userinfo', 'userid', 'CASCADE', 'CASCADE');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('peringatan', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('peringatan');
	}
}
