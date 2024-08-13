<?php

namespace App\Filament\Resources\Postpost6sResource\Pages;

use App\Filament\Resources\Postpost6sResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostpost6s extends EditRecord
{
    protected static string $resource = Postpost6sResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
