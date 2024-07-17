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

    protected function beforeSave()
    {

        // create tag name n location
        $formatName = strtolower(preg_replace('/(?<!^)(?=[A-Z])/', '-', $this->record->LayoutName));
        $this->record->Tag = "<x.layout.{$formatName}>";
        $this->record->Location = "resource/views/components/layout/{$formatName}.blade.php";

        // creae view, javascript, and css using artisan

    }
}
