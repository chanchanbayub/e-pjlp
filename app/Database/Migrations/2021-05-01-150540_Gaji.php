<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Gaji extends Migration
{
	public function up()
	{
		$this->forge->addField([

			'id_gaji'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'userid'       => [
				'type'       => 'INT',
				'constraint' => 11,
				'null'		=> false,
			],
			'gaji'       => [
				'type'       => 'INT',
				'constraint' => 11,
				'null'		=> true,
			],
			'tunjangan' => [
				'type'       => 'INT',
				'constraint' => 11,
				'null'		=> true,
			],
			'periode_awal' => [
				'type' => 'date',
				'null' => true,
			],
			'periode_akhir' => [
				'type' => 'date',
				'null' => true,
			],
			'potongan'	=> [
				'type' => 'INT',
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
		$this->forge->addKey('id_gaji', true);
		$this->forge->addForeignKey('userid', 'userinfo', 'userid', 'CASCADE', 'CASCADE');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('gaji', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('gaji');
	}
}
