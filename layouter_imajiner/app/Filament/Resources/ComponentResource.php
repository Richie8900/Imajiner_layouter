<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComponentResource\Pages;
use App\Filament\Resources\ComponentResource\RelationManagers;
use App\Models\Component;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

use App\Models\Pages as PagesModel;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;

class ComponentResource extends Resource
{
    protected static ?string $model = Component::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Layouter';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextArea::make('ComponentName')
                    ->label('Component name')
                    ->required(),
                Forms\Components\TextArea::make('Description')
                    ->label('Description')
                    ->required(),
                Forms\Components\TextArea::make('Script')
                    ->label('Script')
                    ->required()
                    ->hiddenOn('edit'),
                Forms\Components\TextArea::make('Location')
                    ->label('Location')
                    ->required()
                    ->hiddenOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ComponentName')
                    ->label("Component name")
                    ->sortable(),
                TextColumn::make('Description')
                    ->label("Description")
                    ->sortable(),
                TextColumn::make('Tag')
                    ->label("Tag")
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->after(function ($record, $action) {
                        // Deletes the component files using artisan command
                        Artisan::call('delete:component', [
                            'type' => 'Component',
                            'name' => $record->ComponentName,
                        ]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComponents::route('/'),
            'create' => Pages\CreateComponent::route('/create'),
            'edit' => Pages\EditComponent::route('/{record}/edit'),
        ];
    }
}
