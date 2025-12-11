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
        Schema::table('live_classes', function (Blueprint $table) {
            $table->foreignId('batch_id')->nullable()->after('class_name')->constrained('batches')->onDelete('cascade');
            $table->dropForeign(['course_id']);
            $table->dropColumn('course_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('live_classes', function (Blueprint $table) {
            $table->foreignId('course_id')->nullable()->after('class_name')->constrained('courses')->onDelete('cascade');
            $table->dropForeign(['batch_id']);
            $table->dropColumn('batch_id');
        });
    }
};
