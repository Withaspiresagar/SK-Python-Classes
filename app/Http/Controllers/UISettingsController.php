<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UISetting;

class UISettingsController extends Controller
{
    /**
     * Get UI settings
     */
    public function index()
    {
        $settings = UISetting::first();
        
        if (!$settings) {
            $settings = UISetting::create([
                // Default values will be set by migration defaults
            ]);
        }
        
        return response()->json([
            'success' => true,
            'settings' => $settings
        ]);
    }

    /**
     * Update UI settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            // Color Scheme
            'primary_color' => 'nullable|string|max:50',
            'secondary_color' => 'nullable|string|max:50',
            'accent_color' => 'nullable|string|max:50',
            'background_color' => 'nullable|string|max:50',
            
            // Typography
            'font_family' => 'nullable|string|max:200',
            'heading_font_family' => 'nullable|string|max:200',
            'base_font_size' => 'nullable|integer|min:10|max:24',
            'heading_font_size_multiplier' => 'nullable|numeric|min:1|max:3',
            'line_height' => 'nullable|numeric|min:1|max:3',
            
            // Button Styles
            'button_border_radius' => 'nullable|integer|min:0|max:50',
            'button_padding' => 'nullable|integer|min:4|max:32',
            'button_style' => 'nullable|string|in:solid,outline,ghost',
            
            // Layout Settings
            'container_max_width' => 'nullable|integer|min:320|max:1920',
            'section_padding' => 'nullable|integer|min:0|max:200',
            'enable_shadows' => 'nullable|boolean',
            'enable_animations' => 'nullable|boolean',
        ]);

        $settings = UISetting::first();
        
        if (!$settings) {
            $settings = new UISetting();
        }

        // Update only provided fields
        foreach ($validated as $key => $value) {
            if ($value !== null) {
                $settings->$key = $value;
            }
        }

        $settings->save();

        return response()->json([
            'success' => true,
            'message' => 'UI settings updated successfully',
            'settings' => $settings
        ]);
    }
}
