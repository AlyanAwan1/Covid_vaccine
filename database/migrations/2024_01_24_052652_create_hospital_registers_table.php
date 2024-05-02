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
        Schema::create('hospital_registers', function (Blueprint $table) {
            $table->id();
            $table->string('Hospital_name');
            $table->string('Hospital_address');
            $table->string('Hospital_email')->unique();
            $table->string('Hospital_status')->default('Pending');
            $table->string('Hospital_password');
            $table->rememberToken();
            $table->string('Hospital_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_registers');
    }
};
