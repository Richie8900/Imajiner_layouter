<?php

namespace App\Filament\Resources\PostPost3sResource\Pages;

use App\Filament\Resources\PostPost3sResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostPost3s extends ListRecords
{
    protected static string $resource = PostPost3sResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
