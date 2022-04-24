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
        Schema::create(config('constant.TBL.HERO'), function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('bio');
            $table->string('avatar');
            $table->tinyInteger('rarity')->comment('Độ hiếm của các hero');
            $table->tinyInteger('element')->comment('Các nguyên tố của các hero');
            $table->tinyInteger('type')->comment('Loại hero');

            $table->integer('attack')->nullable()->default(0);
            $table->integer('health')->nullable()->default(0);
            $table->integer('defend')->nullable()->default(0);

            $table->unsignedFloat('eva_rate')->nullable()->default(0)->comment('Thân pháp');
            $table->unsignedFloat('aim_rate')->nullable()->default(0)->comment('Chính xác');
            $table->unsignedFloat('crit_rate')->nullable()->default(0)->comment('Bonus tỉ lệ chí mạng');
            $table->unsignedFloat('crit_damage')->nullable()->default(0)->comment('Bonus sát thương chí mạng');

            $table->unsignedFloat('exp_rate')->nullable()->default(0)->comment('Tốc độ tu luyện');
            $table->unsignedFloat('coin_rate')->nullable()->default(0)->comment('Tốc độ thu thập tiền');

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
        Schema::dropIfExists(config('constant.TBL.HERO'));
    }
};
