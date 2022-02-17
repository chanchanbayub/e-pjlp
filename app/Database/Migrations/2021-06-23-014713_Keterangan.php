<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Keterangan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_keterangan' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'keterangan' => [
				'type' => 'varchar',
				'constraint' =>  255,
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
		$this->forge->addKey('id_keterangan', true);
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('keterangan', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable("keterangan");
	}
}
