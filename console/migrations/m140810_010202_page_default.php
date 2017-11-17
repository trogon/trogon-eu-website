<?php

use yii\db\Schema;
use yii\db\Migration;

class m140810_010202_page_default extends Migration
{
	public function up()
	{
		$this->insert('{{%page}}', [
			'title' => 'Home page',
			'alias' => 'home-page',
			'content' => '<div class="jumbotron"><h1>This home page is not configured!</h1><p class="lead">To configure this page you need go to admin panel!</p></div>',
			'user_id' => null,
			'created_at' => time(),
		]);
		$this->insert('{{%page}}', [
			'title' => 'About page',
			'alias' => 'about-page',
			'content' => '<div class="jumbotron"><h1>This about page is not configured!</h1><p class="lead">To configure this page you need go to admin panel!</p></div>',
			'user_id' => null,
			'created_at' => time(),
		]);
		$this->insert('{{%page}}', [
			'title' => 'Contact page',
			'alias' => 'contact-page',
			'content' => '<div class="jumbotron"><h1>This contact page is not configured!</h1><p class="lead">To configure this page you need go to admin panel!</p></div>',
			'user_id' => null,
			'created_at' => time(),
		]);
		$this->insert('{{%page}}', [
			'title' => 'Admin home page',
			'alias' => 'admin-home-page',
			'content' => '<div class="jumbotron"><h1>This admin home page is not configured!</h1><p class="lead">To configure this page you need go to admin panel!</p></div>',
			'user_id' => null,
			'created_at' => time(),
		]);
	}

	public function down()
	{
		$this->delete('{{%page}}', ['alias' => 'home-page']);
		$this->delete('{{%page}}', ['alias' => 'about-page']);
		$this->delete('{{%page}}', ['alias' => 'contact-page']);
		$this->delete('{{%page}}', ['alias' => 'admin-home-page']);
	}
}
