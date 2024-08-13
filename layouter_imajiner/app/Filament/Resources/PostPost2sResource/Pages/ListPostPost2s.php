<?php

namespace App\Filament\Resources\PostPost2sResource\Pages;

use App\Filament\Resources\PostPost2sResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostPost2s extends ListRecords
{
    protected static string $resource = PostPost2sResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
