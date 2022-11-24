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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users")
                ->cascadeOnDelete();
            $table->bigInteger("price");
            $table->enum("status", ["unpaid", "canceled",
                "notPosted", "posted", "Received", "paid"]);

            $table->timestamps();
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->unsignedBigInteger("product_id");
            $table->foreign("product_id")->references("id")->on("products")
                ->cascadeOnDelete();
            $table->unsignedBigInteger("order_id");
            $table->foreign("order_id")->references("id")->on("orders")
                ->cascadeOnDelete();
            $table->integer("quantity");
            $table->primary(["order_id", "product_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
    }
};
