<?php

namespace App\Filament\Resources\PostCategoryResource\Pages;

use App\Filament\Resources\PostCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\DataSyncController;

class EditPostCategory extends EditRecord
{
    protected static string $resource = PostCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // redirect to index page
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function sync_db_with_script()
    {
        DataSyncController::syncPostCategory($this->record->id);
        return Redirect::to($this->getResource()::getUrl('index'));
    }

    public function sync_script_with_db()
    {
        $data = $this->record;
        if (File::exists(resource_path($data['viewLocation']))) {
            File::put(resource_path($data['viewLocation']), $data['viewScript']);
        }

        $cssPath = $data['resourceLocation'] . "/" . $data['slug'] . ".css";
        $jsPath = $data['resourceLocation'] .  "/" . $data['slug'] . ".js";

        if (File::exists(public_path($data['resourceLocation'])) && File::exists(public_path($cssPath)) && File::exists(public_path($jsPath))) {
            File::put($cssPath, $data['cssScript']);
            File::put($jsPath, $data['jsScript']);
        }

        $data->fill($this->form->getState());
        $data->save();
        return Redirect::to($this->getResource()::getUrl('index'));
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {

        if (File::exists(resource_path($data['viewLocation']))) {
            File::put(resource_path($data['viewLocation']), $data['viewScript']);
        }

        $cssPath = public_path($data['resourceLocation'] . "/" . $data['slug'] . ".css");
        $jsPath = public_path($data['resourceLocation'] .  "/" . $data['slug'] . ".js");

        if (File::exists(public_path($data['resourceLocation'])) && File::exists($cssPath) && File::exists($jsPath)) {
            File::put($cssPath, $data['cssScript']);
            File::put($jsPath, $data['jsScript']);
        }

        return $data;
    }
}
