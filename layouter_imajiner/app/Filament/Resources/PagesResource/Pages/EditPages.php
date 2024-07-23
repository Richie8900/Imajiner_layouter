<?php

namespace App\Filament\Resources\PagesResource\Pages;

use App\Filament\Resources\PagesResource;
use Exception;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\File;

class EditPages extends EditRecord
{
    protected static string $resource = PagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // $script = File::get(resource_path($data['Location']));
        // $name = ;
        $script = File::get(resource_path('views/' . $data['PageName'] . '.blade.php'));
        // $script = $data['id'];
        $data['Script'] = $script;
        return $data;
    }
}
