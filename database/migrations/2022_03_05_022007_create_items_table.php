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
            $table->unsignedInteger('attribute_id');
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->text('description');
            $table->unsignedInteger('price');
            $table->unsignedInteger('discount');
            $table->string('icon_name')->nullable();
            $table->string('icon_path')->nullable();
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
        Schema::dropIfExists(config('constant.TBL.ITEM'));
    }
};
