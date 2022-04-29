<?php

use App\Enums\UserStatus;
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
        Schema::table(config('constant.TBL.USER'), function (Blueprint $table) {
            $table->tinyInteger('status')->default(UserStatus::ACTIVE->value);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('constant.TBL.USER'), function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
