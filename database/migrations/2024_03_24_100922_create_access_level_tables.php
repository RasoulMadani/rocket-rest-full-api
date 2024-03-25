<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('no action');
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('no action');

            // جون در این جدول آیدی نداریم به جای آن این دو فیلد رو پرایمری می کنیم تا
            // همزمان دو تا فیلد با مقدار یکسان نداشته باشیم یعنی حتما این ورودی مشابه نداشته باشد

            $table->primary(['user_id', 'role_id']);
        });
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('permission_id')->references('id')->on('permissions')->onUpdate('cascade')->onDelete('no action');
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('no action');

            // جون در این جدول آیدی نداریم به جای آن این دو فیلد رو پرایمری می کنیم تا
            // همزمان دو تا فیلد با مقدار یکسان نداشته باشیم یعنی حتما این ورودی مشابه نداشته باشد
            
            $table->primary(['role_id', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
};
