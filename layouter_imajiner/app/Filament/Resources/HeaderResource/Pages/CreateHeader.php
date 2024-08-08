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
        // generate slug
        $data['slug'] = Str::slug($data['name']);

        // create component files > create resource/views/components/... + app/View/Components/...
        Artisan::call('make:component', [
            'name' => 'header/' . $data['slug'],
        ]);

        // create component files > create public/static/...-resource
        Artisan::call('make:static', [
            'name' => 'header/' . $data['slug'],
        ]);

        // insert script into view
        $data['viewLocation'] = "views/components/header/{$data['slug']}.blade.php";
        File::put(resource_path($data['viewLocation']), $data['viewScript']);

        // insert js n css file into resource folder
        $data['resourceLocation'] = "static/header/" . $data['slug'] . "-resource";
        $cssPath = $data['resourceLocation'] . "/" . $data['slug'] . ".css";
        $jsPath = $data['resourceLocation'] .  "/" . $data['slug'] . ".js";
        File::put($cssPath, $data['cssScript']);
        File::put($jsPath, $data['jsScript']);

        return $data;
    }
}
