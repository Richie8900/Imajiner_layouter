<?php

namespace App\Filament\Resources\PagesResource\Pages;

use App\Filament\Resources\PagesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CreatePages extends CreateRecord
{
    protected static string $resource = PagesResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // create tag name n location
        $formatName = strtolower(preg_replace('/(?<!^)(?=[A-Z])/', '-', $data['PageName']));
        $data['Tag'] = $formatName;
        $data['Location'] = resource_path("/views/{$formatName}.blade.php");

        // create view, javascript, and css using artisan
        Artisan::call('make:static', [
            'name' => $formatName,
        ]);
        Artisan::call('make:view', [
            'name' => $data['PageName'],
        ]);

        // put script into the view file (NOT DONE, STILL DUMMY)
        File::put(resource_path("/views/{$formatName}.blade.php"), $data['Script']);

        $data['Script'] = resource_path("/views/{$formatName}.blade.php");

        // create route
        Artisan::call('make:route', [
            'name' => $data['Route'],
        ]);

        return $data;
    }
}
