<?php

namespace App\Filament\Resources\postarticlesResource\Pages;

use App\Filament\Resources\postarticlesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Str;

class Createpostarticles extends CreateRecord
{
    protected static string $resource = postarticlesResource::class;

    // redirect to index page
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['title']);

        return $data;
    }
}