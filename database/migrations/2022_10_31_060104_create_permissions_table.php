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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("label")->nullable();
            $table->timestamps();
        });
        Schema::create('admin_permission', function (Blueprint $table) {

            $table->unsignedBigInteger("admin_id");
            $table->foreign("admin_id")
                ->references("id")
                ->on("admins");
            $table->unsignedBigInteger("permission_id");
            $table->foreign("permission_id")
                ->references("id")
                ->on("permissions");
            $table->primary(["admin_id","permission_id"]);

        });
        Schema::create('permission_role', function (Blueprint $table) {

            $table->unsignedBigInteger("permission_id");
            $table->foreign("permission_id")
                ->references("id")
                ->on("permissions");
            $table->unsignedBigInteger("role_id");
            $table->foreign("role_id")
                ->references("id")
                ->on("roles");
            $table->primary(["permission_id","role_id"]);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("admin_permission");
        Schema::dropIfExists('permissions');
    }
};
