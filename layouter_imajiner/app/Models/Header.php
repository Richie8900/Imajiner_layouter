<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Header extends Model
{
    use HasFactory;

    protected $fillable = [
        'HeaderName',
        'Description',
        'Script',
        'Tag',
        'Location'
    ];

    public function pages(): BelongsTo
    {
        return $this->BelongsTo(Header::class);
    }
}
