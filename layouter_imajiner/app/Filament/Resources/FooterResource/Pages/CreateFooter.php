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

    // redirect after create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // create tag name n location
        $formatName = strtolower(preg_replace('/(?<!^)(?=[A-Z])/', '-', $data['FooterName']));
        $data['Tag'] = $formatName;
        $data['Location'] = "views/components/footer/{$formatName}.blade.php";

        // artisan make:component
        Artisan::call('make:component', [
            'name' => 'Footer/' . $data['FooterName'],
        ]);

        // replace existing script
        File::put(resource_path("views/components/footer/{$formatName}.blade.php"), $data['Script']);

        return $data;
    }
}
