<?php

namespace App\Filament\Resources\TestTableResource\Pages;

use App\Filament\Resources\TestTableResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTestTable extends CreateRecord
{
    protected static string $resource = TestTableResource::class;
}
