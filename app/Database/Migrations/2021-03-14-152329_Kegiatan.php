<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kegiatan extends Migration
{
	public function up()
	{
		$this->forge->addField([

			'kegiatan_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'userid'       => [
				'type'       => 'INT',
				'constraint' => 11,
				'null'		 => false
			],
			'kegiatan' 		=> [
				'type' 		=> 'VARCHAR',
				'constraint' => '255',
				'null' 		=> true,
			],
			'tanggal' 		=> [
				'type' 		=> 'DATE',
				'null' 		=> true,
			],
			'jam' 		=> [
				'type'	=> 'TIME',
				'null' 	=> true,
			],
			'selesai'	=> [
				'type'	=> 'TIME',
				'null'	=> true,
			],
			'status' 	=> [
				'type'	=> 'VARCHAR',
				'null'	=> true,
				'constraint' => 255,
			],
			'bobot'		=> [
				'type' 	=> 'VARCHAR',
				'null'	=> true,
				'constraint' => 255,
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
		$this->forge->addKey('kegiatan_id', true);
		$this->forge->addForeignKey('userid', 'userinfo', 'userid', 'CASCADE', 'CASCADE');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('kegiatan', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('kegiatan');
	}
}
