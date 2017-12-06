<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_profiles', function (Blueprint $table) {
            $table->integer('usp_usr_id')->unsigned();
            $table->integer('usp_prf_id')->unsigned();

            $table->foreign('usp_usr_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('usp_prf_id')->references('prf_id')->on('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_profiles');
    }
}
