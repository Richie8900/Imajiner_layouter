<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Support\Facades\Artisan;

class Footer extends Model
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

    public function pages(): BelongsTo
    {
        return $this->BelongsTo(Footer::class);
    }

    public function postCategory(): BelongsTo
    {
        return $this->BelongsTo(Footer::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($record) {
            // Custom logic after deletion
            Artisan::call('delete:component', [
                'category' => 'footer',
                'name' => $record->name,
            ]);
            Artisan::call('delete:static', [
                'name' => 'footer/' . $record->slug,
            ]);
        });
    }
}
