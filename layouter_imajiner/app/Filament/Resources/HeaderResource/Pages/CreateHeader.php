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

        // create component files > create resource/views/components + app/View/Components/
        Artisan::call('make:component', [
            'name' => 'header/' . $data['slug'],
        ]);

        $data['viewLocation'] = "views/components/header/{$data['slug']}.blade.php";
        $data['resourceLocation'] = "static/header/" . $data['slug'] . "-resource";


        // put script into the view file
        File::put(resource_path($data['location']), $data['script']);

        // replace existing script
        File::put(resource_path("views/components/header/{$data['slug']}.blade.php"), $data['Script']);

        //create static file
        Artisan::call('make:static', [
            'name' => 'header/' . $data['slug'],
        ]);

        $staticDirectory = public_path('static/' . $data['slug'] . '-resource');

        // assign 
        $cssPath = $directory . "/{$name}.css";
        $jsPath = $directory . "/{$name}.js";

        if (File::exists($cssPath) || File::exists($jsPath)) {
            $this->error("File {$name} already exists.");
            return;
        }

        // Create the file with a basic structure based on type
        File::put($cssPath, "/* Styles for {$name} */\n");
        File::put($jsPath, "// Script for {$name}\n");

        return $data;
    }
}
