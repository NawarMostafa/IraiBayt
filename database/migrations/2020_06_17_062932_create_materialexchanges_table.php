<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialexchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materialexchanges', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('material_id');
            $table->unsignedInteger('currancy_id');
            $table->double('price');
            $table->date('day');
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
        Schema::dropIfExists('materialexchanges');
    }
}
