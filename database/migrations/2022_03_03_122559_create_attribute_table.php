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
            $table->integer('attack')->nullable()->default(0);
            $table->integer('health')->nullable()->default(0);
            $table->integer('defend')->nullable()->default(0);

            $table->unsignedFloat('eva_rate')->nullable()->default(0)->comment('Thân pháp');
            $table->unsignedFloat('aim_rate')->nullable()->default(0)->comment('Chính xác');
            $table->unsignedFloat('crit_rate')->nullable()->default(0)->comment('Bonus tỉ lệ chí mạng');
            $table->unsignedFloat('crit_damage')->nullable()->default(0)->comment('Bonus sát thương chí mạng');

            $table->unsignedFloat('exp_rate')->nullable()->default(0)->comment('Tốc độ tu luyện');
            $table->unsignedFloat('coin_rate')->nullable()->default(0)->comment('Tốc độ thu thập tiền');
            $table->unsignedFloat('gem_rate')->nullable()->default(0)->comment('Tốc độ thu thập linh thạch');
            $table->unsignedFloat('spirit_rate')->nullable()->default(0)->comment('Tốc độ thu thập linh hồn');
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
