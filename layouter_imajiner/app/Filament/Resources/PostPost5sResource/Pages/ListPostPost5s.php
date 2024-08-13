<?php

namespace App\Filament\Resources\PostPost5sResource\Pages;

use App\Filament\Resources\PostPost5sResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostPost5s extends ListRecords
{
    protected static string $resource = PostPost5sResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
