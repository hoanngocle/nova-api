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
            $table->tinyInteger('gender')->nullable()->comment('0: Female, 1: Male');
            $table->text('bio')->nullable();
            $table->string('skin')->nullable()->comment('Url to image skin');
            $table->string('avatar')->nullable()->comment('Url to avatar');

            // Stat
            $table->integer('attack')->default(0)->comment('Tấn công');
            $table->integer('health')->default(0)->comment('Máu');
            $table->integer('defend')->default(0)->comment('Phòng thủ');

            $table->unsignedFloat('eva')->default(0)->comment('Thân pháp');
            $table->unsignedFloat('aim')->default(0)->comment('Chính xác');
            $table->unsignedFloat('crit_rate')->default(0)->comment('Bonus tỉ lệ chí mạng');
            $table->unsignedFloat('crit_damage')->default(0)->comment('Bonus sát thương chí mạng');

            $table->unsignedFloat('exp_rate')->default(0)->comment('Tốc độ tu luyện');
            $table->unsignedFloat('coin_rate')->default(0)->comment('Tốc độ thu thập tiền');
            $table->unsignedFloat('gem_rate')->default(0)->comment('Tốc độ thu thập linh thạch');
            $table->unsignedFloat('spirit_rate')->default(0)->comment('Tốc độ thu thập linh hồn');

            // Level and job level
            $table->unsignedInteger('job_pharmacist_level')->default(0)->comment('luyện dược sư');
            $table->unsignedInteger('job_pharmacist_exp')->default(0)->comment('kinh nghiệm luyện dược sư');
            $table->unsignedInteger('job_alchemist_level')->default(0)->comment('luyện khí sư');
            $table->unsignedInteger('job_alchemist_exp')->default(0)->comment('kinh nghiệm luyện khí sư');

            // Currency and Level
            $table->unsignedInteger('inventory_size');
            $table->unsignedBigInteger('gem')->comment('Linh thạch lưu thông');
            $table->unsignedBigInteger('coin')->comment('Kim tệ lưu thông');
            $table->unsignedInteger('level')->default(1);
            $table->unsignedBigInteger('exp')->default(0);

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
        Schema::dropIfExists(config('constant.TBL.CHARACTER'));
    }
}
