<?php

namespace App\Filament\Resources\PagesResource\Pages;

use App\Filament\Resources\PagesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use App\Models\TestTable;

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
        $data['Location'] = "/views/{$formatName}.blade.php";

        // create view, javascript, and css using artisan
        Artisan::call('make:static', [
            'name' => $formatName,
        ]);
        Artisan::call('make:view', [
            'name' => $data['PageName'],
        ]);

        $tag = '$data->PageName';

        // $layoutTagOpen = "<x-layout." . TestTable::find($data['LayoutId']) . "tag='{{ $tag }}'>";
        // $layoutTagClose = "</x-layout." . TestTable::find($data['LayoutId']) . ">";
        // $headerTag = "<x-header." . TestTable::find($data['HeaderId']) . " title='Insert Title Here'/>";
        // $footerTag = "<x-footer." . TestTable::find($data['LayoutId']) . "/>";

        $layoutTagOpen = "<x-layout." . 'example-layout' . " tag='{{ $tag }}'>";
        $layoutTagClose = "</x-layout." . 'example-layout' . ">";
        $headerTag = "<x-header." . 'example-header' . " title='Insert Title Here'/>";
        $footerTag = "<x-footer." . 'example-footer' . "/>";

        // structuring the script
        $data['Script'] =
            "$layoutTagOpen
            $headerTag
            {{-- Separator --}} 

            {{-- Content here, you can delete this comment but please don't delete the 'Separator' comment, as it is used to mark where your content starts in order to save it from the filament page thanks! --}}
        
            {{-- Separator --}} 

            $footerTag
        $layoutTagClose";

        // put script into the view file
        File::put(resource_path($data['Location']), $data['Script']);

        // create route
        Artisan::call('make:route', [
            'name' => $data['Route'],
        ]);

        return $data;
    }
}
