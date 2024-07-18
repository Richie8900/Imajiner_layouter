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
        $data['Tag'] = $formatName;
        $data['Location'] = resource_path("/views/components/Layout/{$formatName}.blade.php");

        return $data;
    }
}
