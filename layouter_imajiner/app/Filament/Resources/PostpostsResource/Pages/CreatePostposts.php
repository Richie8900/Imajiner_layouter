<?php

namespace App\Filament\Resources\postpostsResource\Pages;

use App\Filament\Resources\postpostsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Str;

class Createpostposts extends CreateRecord
{
    protected static string $resource = postpostsResource::class;

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