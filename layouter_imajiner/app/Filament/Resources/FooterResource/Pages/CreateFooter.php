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
        // create tag name n location
        $data['slug'] = Str::slug($data['FooterName']);
        $data['Tag'] = $data['slug'];
        $data['Location'] = "views/components/component/{$data['slug']}.blade.php";

        // artisan make:component
        Artisan::call('make:component', [
            'name' => 'Footer/' . $data['FooterName'],
        ]);

        // replace existing script
        File::put(resource_path("views/components/component/{$data['slug']}.blade.php"), $data['Script']);

        return $data;
    }
}
