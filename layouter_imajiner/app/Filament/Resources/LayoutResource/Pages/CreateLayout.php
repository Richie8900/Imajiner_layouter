<?php

namespace App\Filament\Resources\LayoutResource\Pages;

use App\Filament\Resources\LayoutResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CreateLayout extends CreateRecord
{
    protected static string $resource = LayoutResource::class;

    // redirect after create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // create tag name n location
        $formatName = strtolower(preg_replace('/(?<!^)(?=[A-Z])/', '-', $data['LayoutName']));
        $data['Tag'] = $formatName;
        $data['Location'] = "views/components/layout/{$formatName}.blade.php";

        // artisan make:component
        Artisan::call('make:component', [
            'name' => 'Layout/' . $data['LayoutName'],
        ]);

        // replace existing script
        File::put(resource_path("views/components/layout/{$formatName}.blade.php"), $data['Script']);

        return $data;
    }
}
