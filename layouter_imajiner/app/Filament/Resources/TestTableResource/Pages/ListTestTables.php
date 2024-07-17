<?php

namespace App\Filament\Resources\TestTableResource\Pages;

use App\Filament\Resources\TestTableResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestTables extends ListRecords
{
    protected static string $resource = TestTableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
