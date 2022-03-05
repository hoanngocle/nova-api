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
            $table->unsignedInteger('attribute_id');
            $table->string('name');
            $table->string('code');
            $table->text('bio');
            $table->string('avatar');
            $table->string('path');
            $table->tinyInteger('rarity')->comment('Độ hiếm của các hero');
            $table->tinyInteger('element')->comment('Các nguyên tố của các hero');
            $table->tinyInteger('type')->comment('Loại hero');
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
