<?php

namespace App\Filament\Resources\Postpost7sResource\Pages;

use App\Filament\Resources\Postpost7sResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostpost7s extends ListRecords
{
    protected static string $resource = Postpost7sResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
