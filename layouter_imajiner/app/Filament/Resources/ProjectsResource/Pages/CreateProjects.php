<?php

namespace App\Filament\Resources\ProjectsResource\Pages;

use App\Filament\Resources\ProjectsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Str;
use Filament\Notifications\Notification;
use App\Models\Projects;

class CreateProjects extends CreateRecord
{
    protected static string $resource = ProjectsResource::class;

    // redirect to index page
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['title']);

        // validation route
        $p = Projects::where('title', $data['title']);
        if (count($p->get()) != 0) {
            Notification::make()
                ->title('Creation Cancelled')
                ->body("Route already in use")
                ->warning()
                ->send();

            $this->halt();
        }

        return $data;
    }
}