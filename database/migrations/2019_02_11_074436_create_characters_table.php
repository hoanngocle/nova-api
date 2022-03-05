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
            $table->unsignedInteger('attribute_id');
            $table->string('nickname')->unique();
            $table->text('bio')->nullable();
            $table->string('skin')->nullable()->comment('Url to image skin');

            // Level and job level
            $table->unsignedInteger('level')->default(1);
            $table->unsignedInteger('exp')->default(0);
            $table->unsignedInteger('job_pharmacist_level')->default(0)->comment('luyện dược sư');
            $table->unsignedInteger('job_pharmacist_exp')->default(0)->comment('kinh nghiệm luyện dược sư');
            $table->unsignedInteger('job_alchemist_level')->default(0)->comment('luyện khí sư');
            $table->unsignedInteger('job_alchemist_exp')->default(0)->comment('kinh nghiệm luyện khí sư');

            // Currency
            $table->unsignedInteger('inventory_size');
            $table->unsignedBigInteger('gem')->comment('Linh thạch lưu thông');
            $table->unsignedBigInteger('coin')->comment('Kim tệ lưu thông');

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
