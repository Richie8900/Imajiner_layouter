<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'LayoutName',
        'Script',
        'Tag',
        'Location'
    ];
}
