<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\TestTable;
use App\Models\Layout;
use App\Models\Header;
use App\Models\Footer;

use Illuminate\Support\Facades\Artisan;

class Pages extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'route',
        'description',
        'viewScript',
        'jsScript',
        'cssScript',
        'tag',
        'viewLocation',
        'resourceLocation',
        'content',
        'layoutId',
        'headerId',
        'footerId'
    ];

    protected $casts = [
        'content' => 'array'
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
                'path' => $record->resourceLocation
            ]);
            Artisan::call('delete:static', [
                'name' => $record->slug,
                'path' => $record->resourceLocation
            ]);
        });
    }
}
