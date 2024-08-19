<?php

namespace App\Filament\Resources\HeaderResource\Pages;

use App\Filament\Resources\HeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class EditHeader extends EditRecord
{
    protected static string $resource = HeaderResource::class;

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
        return Redirect::to("/componentPreview/header/{$id}");
    }

    public function syncScriptToDb() {}

    public function syncDbToScript() {}

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (File::exists(resource_path($data['viewLocation']))) {
            File::put(resource_path($data['viewLocation']), $data['viewScript']);
        }

        $cssPath = $data['resourceLocation'] . "/" . $data['slug'] . ".css";
        $jsPath = $data['resourceLocation'] .  "/" . $data['slug'] . ".js";

        if (File::exists(public_path($data['resourceLocation'])) && File::exists(public_path($cssPath)) && File::exists(public_path($jsPath))) {
            File::put($cssPath, $data['cssScript']);
            File::put($jsPath, $data['jsScript']);
        }

        return $data;
    }
}
