<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Artisan;

class PostPost3s extends Model
{
    use HasFactory;

    protected $table = 'PostPost3s';

    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    protected $casts = [
        'content' => 'array'
    ];
}