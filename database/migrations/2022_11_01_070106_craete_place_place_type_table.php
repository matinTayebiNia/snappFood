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
        Schema::create("place_placetype", function (Blueprint $table) {
            $table->unsignedBigInteger("placetype_id");
            $table->foreign("placetype_id")
                ->references("id")
                ->on("placetypes")->cascadeOnDelete();
            $table->unsignedBigInteger("place_id");
            $table->foreign("place_id")
                ->references("id")
                ->on("places")->cascadeOnDelete();
            $table->primary(["placetype_id", "place_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
