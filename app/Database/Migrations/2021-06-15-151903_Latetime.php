<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Latetime extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'latetime_id' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'idlatetime' => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'useridLatetime' => [
				'type' => 'INT',
				'constraint' 	=> 11,
				'null'			=> false,
			],
			'tanggal'			=> [
				'type'  		=> "date",
				'null'			=> true
			],
			'checktype' 		=> [
				'type'			=> "INT",
				'null'			=> false,
			],
			'interval'			=> [
				'type'			=> "time",
				'null'			=> true
			],
			'created_at' 		=> [
				'type'   		=> "DATETIME",
				'null'			=> true,
			],
			'updated_at'		=> [
				'type' 			=> "DATETIME",
				'null' 			=> true,
			],
		]);
		$this->forge->addKey('latetime_id', true);
		$this->forge->addForeignKey('userid', 'userinfo', 'userid', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('idlatetime', 'checkinout', 'id', 'CASCADE', 'CASCADE');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('latetime', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable("latetime");
	}
}
