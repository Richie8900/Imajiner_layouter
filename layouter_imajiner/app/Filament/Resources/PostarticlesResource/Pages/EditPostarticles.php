<?php

namespace App\Filament\Resources\PostarticlesResource\Pages;

use App\Filament\Resources\PostarticlesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostarticles extends EditRecord
{
    protected static string $resource = PostarticlesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
