<?php

namespace App\Filament\Resources\PostPostsResource\Pages;

use App\Filament\Resources\PostPostsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostPosts extends EditRecord
{
    protected static string $resource = PostPostsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // redirect to index page
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
