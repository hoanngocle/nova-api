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
        Schema::create(config('constant.TBL.WEAPON'), function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('attribute_id');
            $table->string('name')->unique();
            $table->string('avatar');
            $table->string('image');
            $table->tinyInteger('rarity')->nullable()->comment('Độ hiếm');
            $table->tinyInteger('element')->nullable()->comment('Loại vũ khí');
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
        Schema::dropIfExists(config('constant.TBL.WEAPON'));
    }
};
