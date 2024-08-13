<?php

namespace App\Filament\Resources\PostPost2sResource\Pages;

use App\Filament\Resources\PostPost2sResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostPost2s extends EditRecord
{
    protected static string $resource = PostPost2sResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
