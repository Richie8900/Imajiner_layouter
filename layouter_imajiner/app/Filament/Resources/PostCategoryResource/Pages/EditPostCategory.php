<?php

namespace App\Filament\Resources\PostCategoryResource\Pages;

use App\Filament\Resources\PostCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use Illuminate\Support\Facades\File;

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
