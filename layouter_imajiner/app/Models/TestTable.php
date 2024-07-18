<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

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
        $this->record->Location = resource_path("/views/components/Layout/{$formatName}.blade.php");

        // creae view, javascript, and css using artisan
        Artisan::call('make:static', [
            'name' => $formatName,
        ]);
        Artisan::call('make:component', [
            'name' => 'Layout/' . $formatName,
        ]);
    }
}
