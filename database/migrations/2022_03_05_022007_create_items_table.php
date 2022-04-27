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
        Schema::create(config('constant.TBL.ITEM'), function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id');
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->text('description');
            $table->unsignedInteger('price');
            $table->unsignedInteger('discount');

            $table->tinyInteger('rarity')->nullable()->comment('Độ hiếm');
            $table->tinyInteger('element')->nullable()->comment('Các nguyên tố');

            $table->integer('attack')->nullable()->default(0);
            $table->integer('health')->nullable()->default(0);
            $table->integer('defend')->nullable()->default(0);

            $table->unsignedFloat('eva')->nullable()->default(0)->comment('Thân pháp');
            $table->unsignedFloat('aim')->nullable()->default(0)->comment('Chính xác');
            $table->unsignedFloat('crit_rate')->nullable()->default(0)->comment('Bonus tỉ lệ chí mạng');
            $table->unsignedFloat('crit_damage')->nullable()->default(0)->comment('Bonus sát thương chí mạng');

            $table->unsignedFloat('exp_rate')->nullable()->default(0)->comment('Tốc độ tu luyện');
            $table->unsignedFloat('coin_rate')->nullable()->default(0)->comment('Tốc độ thu thập tiền');
            $table->unsignedFloat('gem_rate')->nullable()->default(0)->comment('Tốc độ thu thập linh thạch');
            $table->unsignedFloat('spirit_rate')->nullable()->default(0)->comment('Tốc độ thu thập linh hồn');

            $table->integer('effect_rate')->nullable()->comment('Tỷ lệ xuất hiện hiệu ứng');
            $table->integer('effect_value')->nullable()->comment('Giá trị xuất hiện của hiệu ứng');

            $table->tinyInteger('is_comsume')->comment('0: Not comsume; 1: Consume');
            $table->tinyInteger('status')->comment('0: Inactive; 1: Active');
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
        Schema::dropIfExists(config('constant.TBL.ITEM'));
    }
};
