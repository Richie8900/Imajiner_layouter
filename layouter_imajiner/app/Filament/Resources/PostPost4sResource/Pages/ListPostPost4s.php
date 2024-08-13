<?php

namespace App\Filament\Resources\PostPost4sResource\Pages;

use App\Filament\Resources\PostPost4sResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostPost4s extends ListRecords
{
    protected static string $resource = PostPost4sResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
