<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use App\Models\Media;
use Illuminate\Support\Facades\File;

class CreateMedia extends CreateRecord
{
    protected static string $resource = MediaResource::class;

    // redirect to index page
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $m = Media::where('path', $data['path'])->get();
        if (count($m) != 0) {
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

        return $data;
    }
}
