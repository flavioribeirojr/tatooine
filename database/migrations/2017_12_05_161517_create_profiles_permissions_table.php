<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_permissions', function (Blueprint $table) {
            $table->integer('pfp_prf_id')->unsigned();
            $table->integer('pfp_prm_id')->unsigned();

            $table->foreign('pfp_prf_id')->references('prf_id')->on('profiles')->onDelete('cascade');
            $table->foreign('pfp_prm_id')->references('prm_id')->on('permissions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_permissions');
    }
}
