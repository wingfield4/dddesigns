<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('title', 1000);
            $table->string('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->string('item_page_url')->unique();

            $table->unsignedBigInteger('thumbnail_image_id')->nullable();
            $table->foreign('thumbnail_image_id')->references('id')->on('images');

            $table->unsignedBigInteger('item_type_id');
            $table->foreign('item_type_id')->references('id')->on('item_types');
            
            $table->boolean('public');
            $table->timestamps();
            $table->dateTimeTz('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
