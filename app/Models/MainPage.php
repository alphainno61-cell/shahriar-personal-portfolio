<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MainPage extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'banner_text',
        'moto',
        'experience',
        'projects',
        'certification',
        'article',
        'books',
        'mentoring',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
<<<<<<< HEAD
        $this->addMediaConversion('main-page-medium')
=======
        $this->addMediaConversion('banner_image')
>>>>>>> master
             ->width(800)
             ->height(600)
             ->sharpen(10);
    }
}