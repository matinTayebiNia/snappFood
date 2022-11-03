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
        Schema::create('attribute_product', function (Blueprint $table) {
            $table->unsignedBigInteger("attribute_id");
            $table->foreign("attribute_id")->references("id")
                ->on("attributes")->cascadeOnDelete();
            $table->unsignedBigInteger("product_id");
            $table->foreign("product_id")->references("id")
                ->on("products")->cascadeOnDelete();
            $table->primary(["product_id", "attribute_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute__product');
    }
};
