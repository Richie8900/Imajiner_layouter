<?php

namespace App\Filament\Resources\postpost7sResource\Pages;

use App\Filament\Resources\postpost7sResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Str;

class Createpostpost7s extends CreateRecord
{
    protected static string $resource = postpost7sResource::class;

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