<?php

namespace App\Filament\Resources\TestTableResource\Pages;

use App\Filament\Resources\TestTableResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Artisan;

class CreateTestTable extends CreateRecord
{
    protected static string $resource = TestTableResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // create tag name n location
        $formatName = strtolower(preg_replace('/(?<!^)(?=[A-Z])/', '-', $data['LayoutName']));
        $data['Tag'] = "<x.layout.{$formatName}>";
        $data['Location'] = resource_path("/views/components/Layout/{$formatName}.blade.php");

        // create view, javascript, and css using artisan
        Artisan::call('make:static', [
            'name' => $formatName,
        ]);
        Artisan::call('make:component', [
            'name' => 'Layout/' . $formatName,
        ]);

        return $data;
    }
}
