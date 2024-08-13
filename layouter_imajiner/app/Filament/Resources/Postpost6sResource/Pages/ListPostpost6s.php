<?php

namespace App\Filament\Resources\Postpost6sResource\Pages;

use App\Filament\Resources\Postpost6sResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostpost6s extends ListRecords
{
    protected static string $resource = Postpost6sResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
