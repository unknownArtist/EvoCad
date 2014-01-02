<?php

use Illuminate\Database\Migrations\Migration;

class CreateOauthTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('oauths', function($table){
			$table->increments('id');
			$table->string('provider');
			$table->integer('pid')->unsigned();
			$table->string('uid',255);
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('oauths');
	}

}