<?php

namespace App\Filament\Resources\TestTableResource\Pages;

use App\Filament\Resources\TestTableResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use Illuminate\Support\Facades\File;

class EditTestTable extends EditRecord
{
    protected static string $resource = TestTableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $script = File::get(resource_path($data['Location']));
        // $name = ;
        // $script = File::get(resource_path('views/' . $data['PageName'] . '.blade.php'));
        // $script = $data['id'];
        $data['Script'] = $script;
        return $data;
    }
}
