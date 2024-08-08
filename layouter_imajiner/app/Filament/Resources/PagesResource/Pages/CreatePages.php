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
        $data['slug'] = Str::slug($data['PageName']);
        $data['Tag'] = $data['slug'];
        $data['Location'] = "views/{$data['slug']}.blade.php";

        // create view, javascript, and css using artisan
        Artisan::call('make:static', [
            'name' => $data['slug'],
        ]);
        Artisan::call('make:view', [
            'name' => $data['slug'],
        ]);

        $layoutTagName = Layout::find($data['LayoutId'])->Tag;
        $headerTagName = Header::find($data['HeaderId'])->Tag;
        $footerTagName = Footer::find($data['FooterId'])->Tag;

        $layoutTagOpen = "<x-layout." . $layoutTagName . ">";
        $layoutTagClose = "</x-layout." . $layoutTagName . ">";
        $headerTag = "<x-header." . $headerTagName . " title='Insert Title Here'/>";
        $footerTag = "<x-footer." . $footerTagName . "/>";

        // structuring the script
        $data['Script'] =
            "$layoutTagOpen
    $headerTag
    <link rel=\"stylesheet\" href=\"{{ asset('static/{$data['slug']}-resource/{$data['slug']}.css') }}\">

    {{-- Content here --}}

    <script src=\"{{ asset('static/{$data['slug']}-resource/{$data['slug']}.js') }}\"></script>
    $footerTag
$layoutTagClose";

        // put script into the view file
        File::put(resource_path($data['Location']), $data['Script']);

        // create route
        // Artisan::call('make:route', [
        //     'name' => $data['PageName'],
        //     'route' => $data['Route'],
        // ]);

        return $data;
    }
}
