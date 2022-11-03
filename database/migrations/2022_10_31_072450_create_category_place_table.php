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
        Schema::create('category_place', function (Blueprint $table) {
            $table->unsignedBigInteger("place_id");
            $table->foreign("place_id")
                ->references("id")->on("places")->cascadeOnDelete();
            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")
                ->references("id")->on("categories")->cascadeOnDelete();
            $table->primary(["place_id","category_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_place');
    }
};
