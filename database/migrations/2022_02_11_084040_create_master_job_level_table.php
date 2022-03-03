<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterJobLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('constant.MASTER_TBL.JOB_LEVEL'), function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->comment('1: luyện đan sư; 2: luyện khí sư');
            $table->unsignedInteger('level');
            $table->unsignedDouble('exp');
            $table->string('name');
            $table->integer('effect');
            $table->string('rarity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('constant.MASTER_TBL.JOB_LEVEL'));
    }
}
