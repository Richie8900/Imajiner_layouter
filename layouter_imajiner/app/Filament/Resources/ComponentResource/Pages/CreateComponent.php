<?php

namespace App\Filament\Resources\ComponentResource\Pages;

use App\Filament\Resources\ComponentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CreateComponent extends CreateRecord
{
    protected static string $resource = ComponentResource::class;

    // redirect after create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // create tag name n location
        $formatName = strtolower(preg_replace('/(?<!^)(?=[A-Z])/', '-', $data['ComponentName']));
        $data['Tag'] = $formatName;
        $data['Location'] = "views/components/component/{$formatName}.blade.php";

        // artisan make:component
        Artisan::call('make:component', [
            'name' => 'Component/' . $data['ComponentName'],
        ]);

        // replace existing script
        File::put(resource_path("views/components/component/{$formatName}.blade.php"), $data['Script']);

        return $data;
    }
}
