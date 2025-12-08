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
        Schema::table('brand_settings', function (Blueprint $table) {
            $table->text('address')->nullable()->after('tagline');
            $table->string('email')->nullable()->after('address');
            $table->string('phone')->nullable()->after('email');
            $table->string('whatsapp')->nullable()->after('phone');
            $table->string('instagram')->nullable()->after('whatsapp');
            $table->string('facebook')->nullable()->after('instagram');
            $table->string('youtube')->nullable()->after('facebook');
            $table->string('twitter')->nullable()->after('youtube');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brand_settings', function (Blueprint $table) {
            $table->dropColumn(['address', 'email', 'phone', 'whatsapp', 'instagram', 'facebook', 'youtube', 'twitter']);
        });
    }
};
