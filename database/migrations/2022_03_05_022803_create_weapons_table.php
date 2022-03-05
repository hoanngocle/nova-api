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
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->text('description');
            $table->string('icon_name')->nullable();
            $table->string('icon_path')->nullable();
            $table->string('image_name')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('effect_rate')->nullable();
            $table->integer('effect_value')->nullable();
            $table->tinyInteger('status')->comment('0: Inactive; 1: Active');
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
        Schema::dropIfExists(config('constant.TBL.WEAPON'));
    }
};
