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
            $table->unsignedInteger('eva')->nullable()->default(0)->comment('Thân pháp');
            $table->unsignedInteger('aim')->nullable()->default(0)->comment('Chính xác');
            $table->unsignedInteger('crit_rate')->nullable()->default(0)->comment('Bonus tỉ lệ chí mạng');
            $table->unsignedInteger('crit_damage')->nullable()->default(0)->comment('Bonus sát thương chí mạng');
            $table->unsignedInteger('exp_rate')->nullable()->default(0)->comment('Tốc độ tu luyện');
            $table->unsignedInteger('coin_rate')->nullable()->default(0)->comment('Tốc độ thu thập tiền');
            $table->unsignedInteger('effect_rate')->nullable()->comment('Tỷ lệ xuất hiện hiệu ứng');
            $table->unsignedInteger('effect_value')->nullable()->comment('Giá trị xuất hiện của hiệu ứng');
            $table->unsignedInteger('sale_price')->nullable()->comment('Giá bán ra');
            $table->unsignedInteger('buy_price')->nullable()->comment('Giá mua vào');
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
