<?php

namespace App\Filament\Resources\PostPost4sResource\Pages;

use App\Filament\Resources\PostPost4sResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostPost4s extends EditRecord
{
    protected static string $resource = PostPost4sResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
