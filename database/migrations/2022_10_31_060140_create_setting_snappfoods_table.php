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
        Schema::create('settingsnappfoods', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("icon")->nullable();
            $table->string("twitter")->nullable();
            $table->string("instagram")->nullable();
            $table->string("youtube")->nullable();
            $table->string("telegram")->nullable();
            $table->string("aparat")->nullable();
            $table->string("linkin")->nullable();

            $table->string("owner")->nullable();
            $table->string("officeNumber")->nullable();
            $table->json("symbols")->nullable();

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
        Schema::dropIfExists('setting_snappfoods');
    }
};
