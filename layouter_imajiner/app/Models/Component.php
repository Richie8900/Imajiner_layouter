<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Artisan;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'viewScript',
        'jsScript',
        'cssScript',
        'tag',
        'viewLocation',
        'resourceLocation',
        'appViewLocation',
        'content'
    ];

    protected $casts = [
        'content' => 'array'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($record) {
            // Custom logic after deletion
            Artisan::call('delete:component', [
                'category' => 'component',
                'name' => $record->name,
            ]);
            Artisan::call('delete:static', [
                'name' => $record->slug,
                'path' => $record->resourceLocation
            ]);
        });
    }
}
