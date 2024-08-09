<?php

namespace App\Filament\Resources\FooterResource\Pages;

use App\Filament\Resources\FooterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
        // generate slug
        $data['slug'] = Str::slug($data['name']);
        $formattedName = str_replace(' ', '', ucwords($data['name']));

        // create component files > create resource/views/components/... + app/View/Components/...
        Artisan::call('make:component', [
            'name' => 'footer/' . $formattedName,
        ]);

        // create component files > create public/static/...-resource
        Artisan::call('make:static', [
            'name' => 'footer/' . $data['slug'],
        ]);

        // insert each script into each files
        $data['viewLocation'] = "views/components/footer/{$data['slug']}.blade.php";
        $data['resourceLocation'] = "static/footer/" . $data['slug'] . "-resource";
        $data['appViewLocation'] = "View/Components/footer/" . $formattedName . ".php";
        $cssPath = $data['resourceLocation'] . "/" . $data['slug'] . ".css";
        $jsPath = $data['resourceLocation'] .  "/" . $data['slug'] . ".js";

        $data['viewScript'] = "<link rel=\"stylesheet\" href=\"{{ asset('" . $cssPath . "') }}\">

" . $data['viewScript'] . "

<script src=\"{{ asset('static/" . $jsPath . "') }}\"></script>";

        File::put(resource_path($data['viewLocation']), $data['viewScript']);
        File::put($cssPath, $data['cssScript']);
        File::put($jsPath, $data['jsScript']);
        Artisan::call('add:appView', [
            'name' => $data['name'],
            'component' => 'footer',
            'location' => $data['appViewLocation']
        ]);

        return $data;
    }
}
