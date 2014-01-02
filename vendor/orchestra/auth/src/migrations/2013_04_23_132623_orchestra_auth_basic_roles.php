<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;

class OrchestraAuthBasicRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $datetime = Carbon::now();

        DB::table('roles')->insert(array(
            'name'       => 'Administrator',
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ));

        DB::table('roles')->insert(array(
            'name'       => 'Member',
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('roles')->delete();
    }
}
