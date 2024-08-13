<?php

namespace App\Filament\Resources\PagesResource\Pages;

use App\Filament\Resources\PagesResource;
use App\Models\Pages;
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

    // redirect after edit
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
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
