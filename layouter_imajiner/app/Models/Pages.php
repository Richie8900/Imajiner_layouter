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
        'PageName',
        'Description',
        'Route',
        'LayoutId',
        'HeaderId',
        'FooterId',
        'Location',
        'Script'
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
