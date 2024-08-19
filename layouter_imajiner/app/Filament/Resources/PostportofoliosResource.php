<?php

namespace App\Filament\Resources;

use App\Filament\Resources\postportofoliosResource\Pages;
use App\Filament\Resources\postportofoliosResource\RelationManagers;
use App\Models\postportofolios;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;

class postportofoliosResource extends Resource
{
    protected static ?string $model = postportofolios::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel  = 'portofolios';
    protected static ?string $navigationGroup = 'Post Categories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->readOnlyOn('edit'),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->readOnlyOn('edit')
                    ->hiddenOn('create'),
                Repeater::make('content')
                    ->label('Content')
                    ->schema([
                        Forms\Components\TextInput::make('title'),
                        Forms\Components\Textarea::make('description'),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label("Title")
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\Listpostportofolios::route('/'),
            'create' => Pages\Createpostportofolios::route('/create'),
            'edit' => Pages\Editpostportofolios::route('/{record}/edit'),
        ];
    }
}