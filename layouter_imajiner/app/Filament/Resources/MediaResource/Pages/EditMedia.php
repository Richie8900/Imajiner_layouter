<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\File;
use App\Models\Media;

class EditMedia extends EditRecord
{
    protected static string $resource = MediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $m = Media::where('path', $data['path'])->get();
        if (count($m) != 0 && $data['path'] != $this->record->getOriginal()['path']) {
            Notification::make()
                ->title('Creation Cancelled')
                ->body("There is already a media that has the path, try changing file name")
                ->warning()
                ->send();

            $this->halt();
        }

        if (strpos($data['path'], ' ')) {
            Notification::make()
                ->title('Creation Cancelled')
                ->body("Image path contains space, please rename it to something that has no space")
                ->warning()
                ->send();

            File::delete(storage_path('app/public/' . $data['path']));

            $this->halt();
        }

        if (File::exists(storage_path('app/public/' . $this->record->getOriginal()['path']))) {
            File::delete(storage_path('app/public/' . $this->record->getOriginal()['path']));
        }

        return $data;
    }
}
