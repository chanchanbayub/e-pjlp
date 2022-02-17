<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jadwal extends Migration
{
	public function up()
	{
		$this->forge->addField([

			'id_jadwal'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'userid'       => [
				'type'       => 'INT',
				'constraint'  => 11,
				'null'		=> false,
			],
			'tanggal_masuk' => [
				'type'  => 'date',
				'null'	=> true,
			],
			'tanggal_pulang'	=> [
				'type'  => 'date',
				'null'	=> true,
			],
			'shift_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
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
		$this->forge->addKey('id_jadwal', true);
		$this->forge->addForeignKey('userid', 'userinfo', 'userid', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('shift_id', 'Shift', 'id_shift', 'SET NULL', 'SET NULL');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('jadwal', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('jadwal');
	}
}
