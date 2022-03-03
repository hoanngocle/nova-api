<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('constant.TBL.ATTRIBUTE'), function (Blueprint $table) {
            $table->id();
            $table->integer('attack');
            $table->integer('health');
            $table->integer('defend');

            $table->unsignedFloat('focus')->nullable()->comment('Chính xác');
            $table->unsignedFloat('evasion')->nullable()->comment('Thân pháp');
            $table->unsignedFloat('crit_rate')->nullable()->comment('Bonus tỉ lệ chí mạng');
            $table->unsignedFloat('crit_damage')->nullable()->comment('Bonus sát thương chí mạng');

            $table->unsignedFloat('exp_rate')->nullable()->comment('Tốc độ thu nạp linh khí');
            $table->unsignedFloat('gold_rate')->nullable()->comment('Tốc độ thu thập nguyên liệu');
            $table->unsignedFloat('spirit_rate')->nullable()->comment('Tốc độ thu thập linh hồn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('constant.TBL.ATTRIBUTE'));
    }
};
