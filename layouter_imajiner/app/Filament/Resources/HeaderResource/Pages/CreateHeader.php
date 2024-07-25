<?php

namespace App\Filament\Resources\HeaderResource\Pages;

use App\Filament\Resources\HeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CreateHeader extends CreateRecord
{
    protected static string $resource = HeaderResource::class;

    // redirect after create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // create tag name n location
        $formatName = strtolower(preg_replace('/(?<!^)(?=[A-Z])/', '-', $data['HeaderName']));
        $data['Tag'] = $formatName;
        $data['Location'] = "views/components/header/{$formatName}.blade.php";

        // artisan make:component
        Artisan::call('make:component', [
            'name' => 'Header/' . $data['HeaderName'],
        ]);

        // replace existing script
        File::put(resource_path("views/components/header/{$formatName}.blade.php"), $data['Script']);

        return $data;
    }
}
