<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\TestTable;

class Pages extends Model
{
    use HasFactory;

    protected $fillable = [
        'PageName',
        'Description',
        'Route',
        'LayoutId',
        'Script'
    ];

    public function test_tables(): HasOne
    {
        return $this->hasOne(TestTable::class);
    }
}
