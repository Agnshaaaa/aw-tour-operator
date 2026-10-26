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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('site_title')->default('AW Tour Operator Surabaya')->after('company_name');
            $table->string('hero_heading')->default('Wujudkan Perjalanan Rombongan Impian')->after('site_title');
            $table->text('hero_subheading')->nullable()->after('hero_heading');
            $table->text('footer_text')->nullable()->after('operational_hours');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['site_title', 'hero_heading', 'hero_subheading', 'footer_text']);
        });
    }
};
