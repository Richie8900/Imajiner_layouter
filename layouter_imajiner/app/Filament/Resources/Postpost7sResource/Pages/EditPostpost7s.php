<?php

namespace App\Filament\Resources\Postpost7sResource\Pages;

use App\Filament\Resources\Postpost7sResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostpost7s extends EditRecord
{
    protected static string $resource = Postpost7sResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
