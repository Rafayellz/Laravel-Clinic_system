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
<<<<<<<< HEAD:database/migrations/2025_12_04_134214_create_staff_table.php
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['active', 'inactive'])->default('active'); 
            $table->timestamps();
========
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
>>>>>>>> ddc77aee7b4c18707f8711c213308079a7f2efc6:database/migrations/2025_11_30_032702_add_user_id_to_bookings_table.php
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<<< HEAD:database/migrations/2025_12_04_134214_create_staff_table.php
        Schema::dropIfExists('staff');
========
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
>>>>>>>> ddc77aee7b4c18707f8711c213308079a7f2efc6:database/migrations/2025_11_30_032702_add_user_id_to_bookings_table.php
    }
};
