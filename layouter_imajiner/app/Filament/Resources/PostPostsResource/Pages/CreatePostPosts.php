<?php

namespace App\Filament\Resources\PostPostsResource\Pages;

use App\Filament\Resources\PostPostsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Str;

class CreatePostPosts extends CreateRecord
{
    protected static string $resource = PostPostsResource::class;

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
