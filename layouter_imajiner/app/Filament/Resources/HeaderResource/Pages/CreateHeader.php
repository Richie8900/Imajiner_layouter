<?php

namespace App\Filament\Resources\HeaderResource\Pages;

use App\Filament\Resources\HeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
        $data['slug'] = Str::slug($data['name']);
        $data['tag'] = $data['slug'];
        $data['location'] = "views/components/header/{$data['slug']}.blade.php";

        // artisan make:component
        Artisan::call('make:component', [
            'name' => 'header/' . $data['slug'],
        ]);

        // artisan make:static
        Artisan::call('make:static', [
            'name' => 'header/' . $data['slug'],
        ]);

        // replace existing script
        File::put(resource_path("views/components/header/{$data['slug']}.blade.php"), $data['Script']);

        return $data;
    }
}
