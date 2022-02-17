<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Perbaikanabsen extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_perbaikan' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'userid' => [
				'type' => 'INT',
				'constraint' =>  11,
				'null'	=> false,
			],
			'jadwal_id' => [
				'type'	=> "INT",
				'constraint' => 11,
				'unsigned' => true,
				'null'	=> false,
			],
			'keterangan_id' => [
				'type'	=> "INT",
				'constraint' => 11,
				'null'	=> true,
				'unsigned' => true,
			],
			'pengajuanPerbaikan' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null'	=> true,
			],
			'status' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => true,
			],
			'file' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null'		=> true,
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
		$this->forge->addKey('id_perbaikan', true);
		$this->forge->addForeignKey("userid", "userinfo", "userid", "CASCADE", "CASCADE");
		$this->forge->addForeignKey("keterangan_id", "keterangan", "id_keterangan", "CASCADE", "CASCADE");
		$this->forge->addForeignKey("jadwal_id", "jadwal", "id_jadwal", "CASCADE", "CASCADE");
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('perbaikanabsen', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('perbaikanabsen');
	}
}
