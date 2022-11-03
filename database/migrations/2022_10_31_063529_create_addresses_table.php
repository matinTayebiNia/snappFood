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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")
                ->references("id")->on("users")->cascadeOnDelete();
            $table->unsignedBigInteger("place_id")->nullable();
            $table->foreign("place_id")
                ->references("id")->on("places")->cascadeOnDelete();

            $table->string("height");
            $table->string("width");

            $table->string("state");
            $table->string("city");
            $table->string("street");
            $table->string("pluck");
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
        Schema::dropIfExists('addresses');
    }
};
