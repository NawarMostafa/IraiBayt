<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->double('price');
            $table->string('currancy_id');
            $table->string('area')->nullable();
            $table->unsignedInteger('unit_id');
            $table->string('rooms')->nullable();
            $table->string('bedroom')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('payment')->nullable();
            $table->string('furniture')->nullable();
            $table->string('carage')->nullable();
            $table->string('num_car')->nullable();
            $table->string('floor')->nullable();
            $table->string('age')->nullable();
            $table->string('num_floor')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('contact')->nullable();//[]
            $table->string('more')->nullable();//[]
            $table->string('tags')->nullable();//[]
            $table->string('active')->nullable()->default('pending');
            $table->string('level')->nullable();
            $table->text('img')->nullable();
            $table->text('imgs')->nullable();

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('region_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('subcat_id');
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
        Schema::dropIfExists('posts');
    }
}
