<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddColumnApprovedInJobListings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('JobListings', function(Blueprint $table) {
			$table->boolean('approved')->after('company_logo');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('JobListings', function(Blueprint $table) {
			$table->dropColumn('approved');
		});
	}

}
