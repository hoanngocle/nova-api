<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterHeroes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('constant.MASTER_TBL.HERO'), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('bio');
            $table->string('avatar');
            $table->string('path');
            $table->tinyInteger('rarity')->comment('Độ hiếm của các hero');
            $table->tinyInteger('element')->comment('Các nguyên tố của các hero');
            $table->tinyInteger('type')->comment('Loại hero');

            $table->integer('attack');
            $table->integer('health');
            $table->integer('defend');
            $table->integer('aim_rate')->nullable()->comment('Tỉ lệ chính xác');
            $table->integer('eva_rate')->nullable()->comment('Tỉ lệ né tránh');
            $table->integer('crit_rate')->nullable()->comment('Bonus tỉ lệ chí mạng');
            $table->integer('crit_damage')->nullable()->comment('Bonus sát thương chí mạng');
            $table->integer('exp_rate')->nullable()->comment('Bonus Tốc độ thu nạp linh khí');
            $table->integer('gold_rate')->nullable()->comment('Bonus Tốc độ thu thập nguyên liệu');
            $table->tinyInteger('status')->comment('0: prepare; 1: released');

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
        Schema::dropIfExists(config('constant.MASTER_TBL.HEROES'));
    }
}
