<?php

namespace App\Filament\Resources\PostPost5sResource\Pages;

use App\Filament\Resources\PostPost5sResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostPost5s extends EditRecord
{
    protected static string $resource = PostPost5sResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
