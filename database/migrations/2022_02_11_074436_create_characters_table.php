<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('nickname', 255)->unique();
            $table->text('bio')->nullable();
            $table->text('skin')->nullable();

            // Current stat, include hero + collection weapon and item
            $table->integer('attack');
            $table->integer('health');
            $table->integer('defend');
            $table->integer('focus')->nullable()->comment('Chính xác');
            $table->integer('evasion')->nullable()->comment('Thân pháp');
            $table->integer('crit_rate')->nullable()->comment('Bonus tỉ lệ chí mạng');
            $table->integer('crit_damage')->nullable()->comment('Bonus sát thương chí mạng');

            $table->integer('exp_rate')->nullable()->comment('Tốc độ thu nạp linh khí');
            $table->integer('gold_rate')->nullable()->comment('Tốc độ thu thập nguyên liệu');
            $table->integer('spirit_rate')->nullable()->comment('Tốc độ thu thập linh hồn');

            // Job data



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
        Schema::dropIfExists('characters');
    }
}
