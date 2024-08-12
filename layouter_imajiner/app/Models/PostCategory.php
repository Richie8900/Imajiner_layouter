<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'content',
        'layoutId',
        'headerId',
        'footerId'
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
}
