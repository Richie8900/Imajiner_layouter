<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Artisan;

class PostCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'route',
        'code',
        'description',
        'viewScript',
        'jsScript',
        'cssScript',
        'viewLocation',
        'resourceLocation',
        'migrationPath',
        'content',
        'layoutId',
        'headerId',
        'footerId',
    ];

    public function layouts(): HasOne
    {
        return $this->hasOne(Layout::class);
    }

    public function headers(): HasOne
    {
        return $this->hasOne(Header::class);
    }

    public function footers(): HasOne
    {
        return $this->hasOne(Footer::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($record) {
            // Custom logic after deletion
            Artisan::call('delete:view', [
                'name' => $record->slug,
                'path' => $record->viewLocation,
            ]);
            Artisan::call('delete:static', [
                'name' => $record->slug,
                'path' => $record->viewLocation,
            ]);
            Artisan::call('delete:database', [
                'name' => $record->code,
                'path' => $record->migrationPath
            ]);
            Artisan::call('delete:filament-resource', [
                'name' => $record->code
            ]);
        });
    }
}
