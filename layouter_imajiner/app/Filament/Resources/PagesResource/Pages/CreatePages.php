<?php

namespace App\Filament\Resources\PagesResource\Pages;

use App\Filament\Resources\PagesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

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
        $formatName = strtolower(preg_replace('/(?<!^)(?=[A-Z])/', '-', $data['PageName']));
        $data['Tag'] = $formatName;
        $data['Location'] = "views/{$formatName}.blade.php";

        // create view, javascript, and css using artisan
        Artisan::call('make:static', [
            'name' => $formatName,
        ]);
        Artisan::call('make:view', [
            'name' => $formatName,
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
    <link rel=\"stylesheet\" href=\"{{ asset('static/$formatName-resource/$formatName.css') }}\">

    {{-- Content here --}}

    <script src=\"{{ asset('static/$formatName-resource/$formatName.js') }}\"></script>
    $footerTag
$layoutTagClose";

        // put script into the view file
        File::put(resource_path($data['Location']), $data['Script']);

        // create route
        Artisan::call('make:route', [
            'name' => $data['PageName'],
            'route' => $data['Route'],
        ]);

        return $data;
    }
}
