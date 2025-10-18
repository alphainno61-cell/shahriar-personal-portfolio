<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Travel extends Model
{
    use HasFactory;
     protected $table = 'travels';

    protected $fillable = [
        'country_name',
        'country_flag_path',
        'map_image_path',
        'order_no',
        'is_active',
    ];
}
