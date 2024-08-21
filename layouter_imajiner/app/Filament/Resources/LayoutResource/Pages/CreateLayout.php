<?php

namespace App\Filament\Resources\LayoutResource\Pages;

use App\Filament\Resources\LayoutResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
        // generate slug
        $data['slug'] = Str::slug($data['name']);
        $formattedName = str_replace(' ', '', ucwords($data['name']));

        // create component files > create resource/views/components/... + app/View/Components/...
        Artisan::call('make:component', [
            'name' => 'layout/' . $formattedName,
        ]);

        // create component files > create public/static/...-resource
        Artisan::call('make:static', [
            'name' => 'layout/' . $data['slug'],
        ]);

        // insert each script into each files
        $data['viewLocation'] = "views/components/layout/{$data['slug']}.blade.php";
        $data['resourceLocation'] = "static/layout/" . $data['slug'] . "-resource";
        $data['appViewLocation'] = "View/Components/layout/" . $formattedName . ".php";
        $cssPath = $data['resourceLocation'] . "/" . $data['slug'] . ".css";
        $jsPath = $data['resourceLocation'] .  "/" . $data['slug'] . ".js";

        $data['viewScript'] = "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <title>Preview</title>
    @vite('resources/css/app.css')
    <link rel=\"stylesheet\" href=\"{{ asset('" . $cssPath . "') }}\">
</head>
<body>

{{ " . '$slot' . " }}

" . $data['viewScript'] . "

<script src=\"{{ asset('" . $jsPath . "') }}\"></script>
</body>
</html>";

        File::put(resource_path($data['viewLocation']), $data['viewScript']);
        File::put($cssPath, $data['cssScript']);
        File::put($jsPath, $data['jsScript']);
        Artisan::call('add:appView', [
            'name' => $data['name'],
            'component' => 'layout',
            'location' => $data['appViewLocation']
        ]);

        return $data;
    }
}
