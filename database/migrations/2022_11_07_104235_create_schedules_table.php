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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("place_id");
            $table->foreign("place_id")->references("id")->on("places")
                ->cascadeOnDelete();
            $table->enum("day", ["saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday"]);
            $table->string("startTime");
            $table->string("endTime");

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
        Schema::dropIfExists('schedules');
    }
};
