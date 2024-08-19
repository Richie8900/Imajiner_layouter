<?php

namespace App\Filament\Resources\PostportofoliosResource\Pages;

use App\Filament\Resources\PostportofoliosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostportofolios extends EditRecord
{
    protected static string $resource = PostportofoliosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
