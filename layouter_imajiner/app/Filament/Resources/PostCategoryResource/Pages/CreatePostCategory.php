<?php

namespace App\Filament\Resources\PostCategoryResource\Pages;

use App\Filament\Resources\PostCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use App\Models\PostCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use Filament\Notifications\Notification;

use App\Models\Layout;
use App\Models\Header;
use App\Models\Footer;
use App\Models\Pages;

class CreatePostCategory extends CreateRecord
{
    protected static string $resource = PostCategoryResource::class;

    // redirect to index page
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // create tag name n location
        $data['slug'] = Str::slug($data['name']);
        $formattedName = str_replace(' ', '', ucwords($data['name']));

        // generate Code for db name
        $data['code'] = $formattedName;
        // $data['code'] = Str::lower(str_replace(' ', '', ucwords(str_replace('_', ' ', $data['code']))));
        if (!Str::endsWith($data['code'], 's') && !Str::endsWith($data['code'], 'S')) {
            $data['code'] = $data['code'] . 's';
        }

        // validation route
        $p = Pages::where('route', $data['route']);
        $pc = PostCategory::where('route', $data['route']);
        if (count($p->get()) != 0 || count($pc->get()) != 0) {
            Notification::make()
                ->title('Creation Cancelled')
                ->body("Route already in use")
                ->warning()
                ->send();

            $this->halt();
        }

        // database validation
        $m = app_path('Models/' . $data['code'] . ".php");
        if (File::exists($m)) {
            Notification::make()
                ->title('Creation Cancelled')
                ->body("Model with " . $data['name'] . " is already in use")
                ->warning()
                ->send();

            $this->halt();
        }

        // create view, javascript, and css using artisan
        Artisan::call('make:view', [
            'name' => 'postCategory/' . $data['slug'],
        ]);

        Artisan::call('make:static', [
            'name' => 'postCategory/' . $data['slug'],
        ]);

        $data['viewLocation'] = "views/postCategory/" . $data['slug'] . ".blade.php";
        $data['resourceLocation'] = "static/postCategory/" . $data['slug'] . "-resource";
        $cssPath = $data['resourceLocation'] . "/" . $data['slug'] . ".css";
        $jsPath = $data['resourceLocation'] .  "/" . $data['slug'] . ".js";

        $layoutTagName = Layout::find($data['layoutId'])->slug;
        $layoutTagOpen = "<x-layout." . $layoutTagName . ">";
        $layoutTagClose = "</x-layout." . $layoutTagName . ">";
        $headerTag = "";
        if ($data['headerId'] != null) {
            $headerTagName = Header::find($data['headerId'])->slug;
            $headerTag = "<x-header." . $headerTagName . "/>";
        }
        $footerTag = "";
        if ($data['footerId'] != null) {
            $footerTagName = Footer::find($data['footerId'])->slug;
            $footerTag = "<x-footer." . $footerTagName . "/>";
        }

        // structuring the script
        $data['viewScript'] =
            "$layoutTagOpen
    $headerTag
    <link rel=\"stylesheet\" href=\"{{ asset('static/{$data['slug']}-resource/{$data['slug']}.css') }}\">

    {{-- Content here --}}

    <script src=\"{{ asset('static/{$data['slug']}-resource/{$data['slug']}.js') }}\"></script>
    $footerTag
$layoutTagClose";

        // put script into the view file
        File::put(resource_path($data['viewLocation']), $data['viewScript']);

        // create model
        Artisan::call('configure:model', [
            'name' => $data['code']
        ]);

        $migrationPath = database_path('migrations/');
        $files = File::files($migrationPath);
        $data['migrationPath'] = $files[count($files) - 1];
        $data['migrationPath'] = 'migrations/' . $data['migrationPath']->getRelativePathname();

        // create filament resource
        Artisan::call('configure:filament', [
            'name' => $data['name'],
            'code' => $data['code'],
            'route' => $data['route'],
        ]);

        return $data;
    }
}
