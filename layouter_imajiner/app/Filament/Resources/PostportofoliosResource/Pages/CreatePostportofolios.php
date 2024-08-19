<?php

namespace App\Filament\Resources\postportofoliosResource\Pages;

use App\Filament\Resources\postportofoliosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Str;

class Createpostportofolios extends CreateRecord
{
    protected static string $resource = postportofoliosResource::class;

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