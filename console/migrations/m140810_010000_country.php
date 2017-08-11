<?php

use yii\db\Schema;
use yii\db\Migration;

class m140810_010000_country extends Migration
{
   public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%country}}', [
			'id' => $this->primaryKey(10)->unsigned(),
			'code' => $this->string(2)->notNull(), // ISO 3166-1 alpha-2
			'language' => $this->string(2)->notNull(), // ISO 639-1
			'currency' => $this->string(3)->notNull(), // ISO 4217
			'name' => $this->string(52)->notNull(), // English name
			'currency_symbol' => $this->string(7),
		], $tableOptions);

		$this->createIndex('{{%UX_country_code}}', '{{%country}}', 'code', true);
		$this->createIndex('{{%UX_country_name}}', '{{%country}}', 'name', true);
	}

	public function down()
	{
		$this->dropTable('{{%country}}');
	}
}
