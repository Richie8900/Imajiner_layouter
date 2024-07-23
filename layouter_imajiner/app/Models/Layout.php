<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Layout extends Model
{
    use HasFactory;

    protected $fillable = [
        'LayoutName',
        'Description',
        'Script',
        'Tag',
        'Location'
    ];

    public function pages(): BelongsTo
    {
        return $this->BelongsTo(Layout::class);
    }
}
