<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bulan extends Migration
{
	public function up()
	{
		$this->forge->addField([

			'bulan_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'number_date'          => [
				'type'           => 'Varchar',
				'constraint'     => 10,
			],
			'name_bulan'       => [
				'type'       => 'Varchar',
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
		$this->forge->addKey('bulan_id', true);
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('bulan', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('bulan');
	}
}
