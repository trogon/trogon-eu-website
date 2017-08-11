<?php

use yii\db\Schema;
use yii\db\Migration;

class m140810_010200_privacy_terms extends Migration
{
	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%privacy_terms}}', [
			'id' => $this->primaryKey(10)->unsigned(),
			'name' => $this->string()->notNull(),
			'content' => $this->text()->notNull(),

			'created_at' => $this->integer(10)->unsigned()->notNull(),
			'updated_at' => $this->integer(10)->unsigned(),
		], $tableOptions);
	}

	public function down()
	{
		$this->dropTable('{{%privacy_terms}}');
	}
}
