<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('AW Tour Operator');
            $table->text('profile_description')->nullable();
            $table->string('location')->nullable();
            $table->json('partners')->nullable();
            $table->string('whatsapp_number', 30)->nullable();
            $table->string('email')->nullable();
            $table->string('operational_hours')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
