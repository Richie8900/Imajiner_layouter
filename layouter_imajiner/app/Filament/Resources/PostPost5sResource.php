<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostPost5sResource\Pages;
use App\Filament\Resources\PostPost5sResource\RelationManagers;
use App\Models\PostPost5s;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;

class PostPost5sResource extends Resource
{
    protected static ?string $model = PostPost5s::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Categories';

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
            'index' => Pages\ListPostPost5s::route('/'),
            'create' => Pages\CreatePostPost5s::route('/create'),
            'edit' => Pages\EditPostPost5s::route('/{record}/edit'),
        ];
    }
}