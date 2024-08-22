<?php

namespace App\Filament\Resources\PostpostsResource\Pages;

use App\Filament\Resources\PostpostsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostposts extends ListRecords
{
    protected static string $resource = PostpostsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
