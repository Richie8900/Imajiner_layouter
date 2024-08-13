<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Artisan;

class postpost6s extends Model
{
    use HasFactory;

    protected $table = 'postpost6s';

    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    protected $casts = [
        'content' => 'array'
    ];
}