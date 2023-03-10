<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('constant.MASTER_TBL.LEVEL'), function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('level');
            $table->unsignedDouble('exp');
            $table->string('name');
            $table->string('sub_name')->nullable();
            $table->string('inner_state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_level');
    }
}
