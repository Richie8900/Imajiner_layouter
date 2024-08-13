<?php

namespace App\Filament\Resources\PostPost3sResource\Pages;

use App\Filament\Resources\PostPost3sResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Str;

class CreatePostPost3s extends CreateRecord
{
    protected static string $resource = PostPost3sResource::class;

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