<?php

use App\Enums\JobType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterJobLevelsTable extends Migration
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
            $table->tinyInteger('type')->default(JobType::FIRE)->comment('1: luyện đan sư; 2: luyện khí sư');
            $table->unsignedInteger('level');
            $table->unsignedDouble('exp');
            $table->string('name');
            $table->string('sub_name');
            $table->string('state');
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
