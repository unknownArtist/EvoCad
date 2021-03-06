<?php

use Illuminate\Database\Migrations\Migration;

class OrchestraMemoryCreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orchestra_options', function ($table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->longText('value');

            $table->unique('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orchestra_options');
    }
}
