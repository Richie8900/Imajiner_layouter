<?php

namespace App\Filament\Resources\LayoutResource\Pages;

use App\Filament\Resources\LayoutResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class EditLayout extends EditRecord
{
    protected static string $resource = LayoutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // redirect after edit
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function redirectToPreview()
    {
        $id = $this->record->id; // Get the current record's ID
        return Redirect::to("/componentPreview/layout/{$id}");
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (File::exists(resource_path($data['Location']))) {
            $script = File::get(resource_path($data['Location']));
            $data['Script'] = $script;
            return $data;
        }

        return $data;
    }
}
