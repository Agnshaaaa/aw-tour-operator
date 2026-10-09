<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transport_offerings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('display_group', ['vehicle', 'body_type'])->default('vehicle');
            $table->string('capacity')->nullable();
            $table->string('price_label')->nullable();
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->string('image')->nullable();
            $table->unsignedSmallInteger('unit_count')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transport_offerings');
    }
};
