<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Artisan;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

    protected $casts = [
        'content' => 'array'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($record) {
            // Custom logic after deletion
            Artisan::call('delete:view', [
                'name' => $record->slug,
            ]);
            Artisan::call('delete:static', [
                'name' => $record->slug,
            ]);
        });
    }
}
