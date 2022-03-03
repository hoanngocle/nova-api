<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('constant.TBL.CHARACTER'), function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('nickname')->unique();
            $table->text('bio')->nullable();
            $table->string('skin')->nullable()->comment('Url to image skin');
            $table->unsignedInteger('attribute_id');

            // Level and job level
            $table->unsignedInteger('level');
            $table->unsignedInteger('exp');
            $table->unsignedInteger('job_pharmacist_level')->comment('luyện dược sư');
            $table->unsignedInteger('job_pharmacist_exp')->comment('kinh nghiệm luyện dược sư');
            $table->unsignedInteger('job_alchemist_level')->comment('luyện khí sư');
            $table->unsignedInteger('job_alchemist_exp')->comment('kinh nghiệm luyện khí sư');

            // Inventory size
            $table->unsignedInteger('inventory_size');

            // Time last login
            $table->timestamp('last_login');
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
        Schema::dropIfExists(config('constant.TBL.CHARACTER'));
    }
}
