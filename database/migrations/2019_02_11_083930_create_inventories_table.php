<?php

use App\Enums\InventoryType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('constant.TBL.INVENTORY'), function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('character_id');
            $table->tinyInteger('type')->default(InventoryType::BAG->value)->comment('1: bag; 2: vault');
            $table->integer('category_id');
            $table->integer('position');
            $table->integer('item_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('constant.TBL.INVENTORY'));
    }
}
