<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\TestTable;
use App\Models\Layout;
use App\Models\Header;
use App\Models\Footer;

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
        'content'
    ];
}
