<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("Basic_cases");
            $table->bigInteger("price");
            $table->string("image");
            $table->unsignedBigInteger('category_id');
            $table->unsignedInteger("count");
            $table->foreign("category_id")
                ->references("id")
                ->on("categories")->cascadeOnDelete();
            $table->unsignedBigInteger('place_id');
            $table->foreign("place_id")
                ->references("id")
                ->on("places")->cascadeOnDelete();
            $table->unsignedTinyInteger("score")->default(1);
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
        Schema::dropIfExists('products');
    }
};
