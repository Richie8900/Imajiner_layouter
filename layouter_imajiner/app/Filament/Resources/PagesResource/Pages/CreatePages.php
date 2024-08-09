<?php

namespace App\Filament\Resources\PagesResource\Pages;

use App\Filament\Resources\PagesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use App\Models\Layout;
use App\Models\Header;
use App\Models\Footer;

class CreatePages extends CreateRecord
{
    protected static string $resource = PagesResource::class;

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

        // create view, javascript, and css using artisan
        Artisan::call('make:view', [
            'name' => $data['slug'],
        ]);

        Artisan::call('make:static', [
            'name' => $data['slug'],
        ]);

        $data['viewLocation'] = "views/{$data['slug']}.blade.php";
        $data['resourceLocation'] = "static/" . $data['slug'] . "-resource";
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

        return $data;
    }
}
