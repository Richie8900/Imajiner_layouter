<?php

namespace App\Filament\Resources\PostPostsResource\Pages;

use App\Filament\Resources\PostPostsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostPosts extends ListRecords
{
    protected static string $resource = PostPostsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
