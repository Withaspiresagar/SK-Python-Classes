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
        Schema::create('ui_settings', function (Blueprint $table) {
            $table->id();
            
            // Sidebar Settings
            $table->string('sidebar_bg_color')->default('#1e1b4b');
            $table->string('sidebar_text_color')->default('#e5e7eb');
            $table->string('sidebar_active_color')->default('#3b82f6');
            $table->string('sidebar_hover_color')->default('#1e40af');
            
            // Header Settings
            $table->string('header_bg_color')->default('#ffffff');
            $table->string('header_text_color')->default('#1f2937');
            $table->string('header_border_color')->default('#e5e7eb');
            
            // Button Settings (keep old fields for backward compatibility)
            $table->string('button_primary_color')->default('#3b82f6');
            $table->string('button_primary_hover')->default('#2563eb');
            $table->string('button_secondary_color')->default('#6b7280');
            $table->string('button_secondary_hover')->default('#4b5563');
            $table->string('button_success_color')->default('#10b981');
            $table->string('button_danger_color')->default('#ef4444');
            
            // Popup/Modal Settings
            $table->string('modal_bg_color')->default('#ffffff');
            $table->string('modal_overlay_color')->default('rgba(0, 0, 0, 0.5)');
            $table->string('modal_border_radius')->default('1rem'); // rounded-2xl
            $table->string('modal_shadow')->default('0 20px 25px -5px rgba(0, 0, 0, 0.1)');
            
            // Card Settings
            $table->string('card_bg_color')->default('#ffffff');
            $table->string('card_border_color')->default('#e5e7eb');
            $table->string('card_border_radius')->default('0.75rem'); // rounded-xl
            $table->string('card_shadow')->default('0 1px 3px 0 rgba(0, 0, 0, 0.1)');
            
            // Table Settings
            $table->string('table_header_bg')->default('#f9fafb');
            $table->string('table_header_text')->default('#1f2937');
            $table->string('table_row_hover')->default('#f3f4f6');
            $table->string('table_border_color')->default('#e5e7eb');
            
            // Input/Form Settings
            $table->string('input_bg_color')->default('#ffffff');
            $table->string('input_border_color')->default('#d1d5db');
            $table->string('input_focus_color')->default('#3b82f6');
            $table->string('input_border_radius')->default('0.5rem'); // rounded-lg
            $table->string('input_padding')->default('0.5rem 0.75rem'); // px-3 py-2
            
            // Typography Settings (keep old fields for backward compatibility)
            $table->string('heading_color')->default('#1f2937');
            $table->string('body_text_color')->default('#4b5563');
            $table->string('link_color')->default('#3b82f6');
            $table->string('link_hover_color')->default('#2563eb');
            
            // General Settings
            $table->string('primary_color')->default('#f96262');
            $table->string('secondary_color')->default('#8B5CF6');
            $table->string('success_color')->default('#10b981');
            $table->string('warning_color')->default('#f59e0b');
            $table->string('danger_color')->default('#ef4444');
            $table->string('info_color')->default('#06b6d4');
            
            // Background Settings
            $table->string('background_color')->default('#F9FAFB');
            $table->string('page_bg_color')->default('#f9fafb');
            $table->string('page_bg_gradient')->nullable();
            
            // Typography Settings (simplified)
            $table->string('font_family')->default('Inter');
            $table->string('heading_font_family')->default('Inter');
            $table->integer('base_font_size')->default(16);
            $table->decimal('heading_font_size_multiplier', 3, 2)->default(1.5);
            $table->decimal('line_height', 3, 2)->default(1.6);
            
            // Button Settings (simplified)
            $table->integer('button_border_radius')->default(8);
            $table->integer('button_padding')->default(12);
            $table->string('button_style')->default('solid');
            
            // Layout Settings
            $table->integer('container_max_width')->default(1280);
            $table->integer('section_padding')->default(80);
            $table->boolean('enable_shadows')->default(true);
            $table->boolean('enable_animations')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ui_settings');
    }
};
