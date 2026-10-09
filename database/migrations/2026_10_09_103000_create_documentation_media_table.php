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
        Schema::create('documentation_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('documentation_id')->constrained('documentations')->cascadeOnDelete();
            $table->string('type')->default('image'); // 'image' or 'video'
            $table->string('file_path'); // storage path or external URL
            $table->string('caption')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentation_media');
    }
};
