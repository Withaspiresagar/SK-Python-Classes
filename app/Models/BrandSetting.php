<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_name',
        'brand_logo',
        'favicon',
        'tagline',
        'address',
        'email',
        'phone',
        'whatsapp',
        'instagram',
        'facebook',
        'youtube',
        'twitter',
    ];

    /**
     * Get the full URL for brand logo
     */
    public function getBrandLogoUrlAttribute()
    {
        if ($this->brand_logo) {
            return asset('storage/' . $this->brand_logo);
        }
        return null;
    }

    /**
     * Get the full URL for favicon
     */
    public function getFaviconUrlAttribute()
    {
        if ($this->favicon) {
            return asset('storage/' . $this->favicon);
        }
        return null;
    }
}
