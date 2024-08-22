<?php

namespace App\Filament\Resources\PostpostsResource\Pages;

use App\Filament\Resources\PostpostsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostposts extends EditRecord
{
    protected static string $resource = PostpostsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
