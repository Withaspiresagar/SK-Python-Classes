<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrandSetting;
use Illuminate\Support\Facades\Storage;

class BrandSettingsController extends Controller
{
    /**
     * Get brand settings
     */
    public function index()
    {
        $settings = BrandSetting::first();
        
        if (!$settings) {
            $settings = BrandSetting::create([
                'brand_name' => 'SK Python Classes',
                'tagline' => 'Master Python Programming with Expert Guidance'
            ]);
        }
        
        return response()->json([
            'success' => true,
            'settings' => $settings
        ]);
    }

    /**
     * Update brand settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:500',
            'brand_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg|max:512',
            'address' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
        ]);

        $settings = BrandSetting::first();
        
        if (!$settings) {
            $settings = new BrandSetting();
        }

        $settings->brand_name = $request->brand_name;
        $settings->tagline = $request->tagline;
        $settings->address = $request->address;
        $settings->email = $request->email;
        $settings->phone = $request->phone;
        $settings->whatsapp = $request->whatsapp;
        $settings->instagram = $request->instagram;
        $settings->facebook = $request->facebook;
        $settings->youtube = $request->youtube;
        $settings->twitter = $request->twitter;

        // Handle brand logo upload
        if ($request->hasFile('brand_logo')) {
            // Delete old logo if exists
            if ($settings->brand_logo && Storage::disk('public')->exists($settings->brand_logo)) {
                Storage::disk('public')->delete($settings->brand_logo);
            }
            
            $logoPath = $request->file('brand_logo')->store('brand', 'public');
            $settings->brand_logo = $logoPath;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            // Delete old favicon if exists
            if ($settings->favicon && Storage::disk('public')->exists($settings->favicon)) {
                Storage::disk('public')->delete($settings->favicon);
            }
            
            $faviconPath = $request->file('favicon')->store('brand', 'public');
            $settings->favicon = $faviconPath;
        }

        $settings->save();

        return response()->json([
            'success' => true,
            'message' => 'Brand settings updated successfully',
            'settings' => $settings
        ]);
    }
}
