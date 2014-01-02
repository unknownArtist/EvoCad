<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobListingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('JobListings', function(Blueprint $table) {
			$table->increments('id');
			$table->string('job_title');
			$table->string('job_type');
			$table->string('job_description');
			$table->string('job_location');
			$table->boolean('job_relocation');
			$table->boolean('job_remotely');
			$table->string('job_apply_by');
			$table->text('job_instruction');
			$table->string('company_name');
			$table->boolean('company_name_status');
			$table->string('company_url',400);
			$table->text('company_descripton');
			$table->string('company_logo');
			$table->boolean('term_and_conditions');
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
		Schema::drop('JobListings');
	}

}
