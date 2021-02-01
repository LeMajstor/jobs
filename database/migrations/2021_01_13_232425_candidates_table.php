<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('offers_id')->unsigned()->nullable();
            $table->string('name', 255);
            $table->string('surname');
            $table->string('city');
            $table->datetime('birthdate');
            $table->string('url')->unique()->nullable();
            $table->string('document')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('candidates');
    }
}
