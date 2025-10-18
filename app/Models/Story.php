<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image_path',
        'order_no',
        'is_active',
    ];

}
