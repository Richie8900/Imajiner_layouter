<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Header extends Model
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
        'content'
    ];
}
