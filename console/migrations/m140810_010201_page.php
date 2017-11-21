<?php

use yii\db\Schema;
use yii\db\Migration;

class m140810_010201_page extends Migration
{
	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%page}}', [
			'id' => $this->primaryKey(10)->unsigned(),
			'title' => $this->string(150)->notNull(),
			'alias' => $this->string(150)->notNull(),
			'content' => $this->text()->notNull(),

			'created_at' => $this->integer(10)->unsigned()->notNull(),
			'updated_at' => $this->integer(10)->unsigned(),

			'user_id' => $this->integer(10)->unsigned(),
		], $tableOptions);
		
		$this->addForeignKey('{{%FK_page_user}}', '{{%page}}', 'user_id', '{{%user}}', 'id');
	}

	public function down()
	{
		$this->dropTable('{{%page}}');
	}
}
