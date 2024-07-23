<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Footer extends Model
{
    use HasFactory;

    public function pages(): BelongsTo
    {
        return $this->BelongsTo(Footer::class);
    }
}
