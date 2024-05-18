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
        Schema::create('tbl_sellers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unique();
            $table->string('name');
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->hash()->nullable();
            $table->string('phone')->unique();
            $table->string('img')->nullable()->nullable();
            $table->enum('sex', ['Nam', 'Nữ', 'Khác']);
            $table->date('DOB');
            $table->text('address');
            $table->text('feedback')->nullable();
            $table->text('history_transaction')->nullable();
            $table->string('name_company');
            $table->enum('type_business', ['individual', 'enterprise']);
             $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sellers');
    }
};