<?php

namespace App\Filament\Resources\HeaderResource\Pages;

use App\Filament\Resources\HeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\DataSyncController;

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

    public function preview()
    {
        return Redirect::to('componentPreview/header/' . $this->record->id);
    }

    public function sync_db_with_script()
    {
        DataSyncController::syncHeader($this->record->id, true);
        return Redirect::to($this->getResource()::getUrl('index'));
    }

    public function sync_script_with_db()
    {
        $this->record->fill($this->form->getState());
        $this->record->save();
        DataSyncController::syncHeader($this->record->id, false);
        return Redirect::to($this->getResource()::getUrl('index'));
    }

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
