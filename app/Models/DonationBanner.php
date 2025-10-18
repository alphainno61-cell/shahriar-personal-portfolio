<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationBanner extends Model
{
     use HasFactory;

    protected $fillable = [
        'section_title',
        'main_quote',
        'image_path',
        'button_text',
        'button_link',
        'is_active',
    ];
}
