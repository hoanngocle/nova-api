<?php

use App\Enums\Gender;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('constant.TBL.PROFILE'), function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('nickname', 255)->unique();
            $table->text('bio')->nullable();
            $table->string('avatar', 255);
            $table->tinyInteger('gender')->unsigned()->default(Gender::FEMALE->value)->nullable()->comment('0: Female, 1: Male');
            $table->datetime('dob')->nullable();
            $table->string('address', 255)->nullable();

            // Training
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
        Schema::dropIfExists(config('constant.TBL.PROFILE'));
    }
}
