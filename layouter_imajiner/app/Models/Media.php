<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\File;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($record) {
            if (FIle::exists(storage_path('app/public/' . $record->path))) {
                File::delete(storage_path('app/public/' . $record->path));
            }
        });
    }
}
