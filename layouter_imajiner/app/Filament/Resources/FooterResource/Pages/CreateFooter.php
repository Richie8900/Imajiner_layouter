<?php

namespace App\Filament\Resources\FooterResource\Pages;

use App\Filament\Resources\FooterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CreateFooter extends CreateRecord
{
    protected static string $resource = FooterResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // create tag name n location
        $formatName = strtolower(preg_replace('/(?<!^)(?=[A-Z])/', '-', $data['FooterName']));
        $data['Tag'] = $formatName;
        $data['Location'] = "/views/components/Footer/{$formatName}.blade.php";

        // artisan make:component
        Artisan::call('make:component', [
            'name' => 'Fototer/' . $data['HeaderName'],
        ]);

        // replace existing script
        File::put(resource_path("/views/components/Footer/{$formatName}.blade.php"), $data['Script']);

        return $data;
    }
}
