<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UISetting extends Model
{
    protected $table = 'ui_settings';
    
    protected $fillable = [
        // Color Scheme
        'primary_color',
        'secondary_color',
        'accent_color',
        'background_color',
        
        // Typography
        'font_family',
        'heading_font_family',
        'base_font_size',
        'heading_font_size_multiplier',
        'line_height',
        
        // Button Styles
        'button_border_radius',
        'button_padding',
        'button_style',
        
        // Layout Settings
        'container_max_width',
        'section_padding',
        'enable_shadows',
        'enable_animations',
        
        // Old fields (for backward compatibility)
        'sidebar_bg_color',
        'sidebar_text_color',
        'sidebar_active_color',
        'sidebar_hover_color',
        'header_bg_color',
        'header_text_color',
        'header_border_color',
        'button_primary_color',
        'button_primary_hover',
        'button_secondary_color',
        'button_secondary_hover',
        'button_success_color',
        'button_danger_color',
        'modal_bg_color',
        'modal_overlay_color',
        'modal_border_radius',
        'modal_shadow',
        'card_bg_color',
        'card_border_color',
        'card_border_radius',
        'card_shadow',
        'table_header_bg',
        'table_header_text',
        'table_row_hover',
        'table_border_color',
        'input_bg_color',
        'input_border_color',
        'input_focus_color',
        'input_border_radius',
        'input_padding',
        'heading_color',
        'body_text_color',
        'link_color',
        'link_hover_color',
        'success_color',
        'warning_color',
        'danger_color',
        'info_color',
        'page_bg_color',
        'page_bg_gradient',
    ];
}
