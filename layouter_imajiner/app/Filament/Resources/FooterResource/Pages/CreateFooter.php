<?php

namespace App\Filament\Resources\FooterResource\Pages;

use App\Filament\Resources\FooterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;
use App\Models\Component;
use App\Models\Header;
use App\Models\Footer;
use App\Models\Layout;

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
        $data['slug'] = Str::slug(preg_replace('/(?<!^)([A-Z])/', ' $1', $data['name']));
        $formattedName = str_replace(' ', '', ucwords($data['name']));

        // validation for name
        $c = Component::where('slug', $data['slug']);
        $h = Header::where('slug', $data['slug']);
        $f = Footer::where('slug', $data['slug']);
        $l = Layout::where('slug', $data['slug']);
        if (count($c->get()) != 0 || count($h->get()) != 0 || count($f->get()) != 0 || count($l->get()) != 0) {
            Notification::make()
                ->title('Creation Cancelled')
                ->body("Component name already in use")
                ->warning()
                ->send();

            $this->halt();
        }

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

<script src=\"{{ asset('" . $jsPath . "') }}\"></script>";

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
