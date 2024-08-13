<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostCategoryResource\Pages;
use App\Filament\Resources\PostCategoryResource\RelationManagers;
use App\Models\PostCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;

class PostCategoryResource extends Resource
{
    protected static ?string $model = PostCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Layouter';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Category Name')
                    ->required()
                    ->readOnlyOn('edit'),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->readOnlyOn('edit')
                    ->hiddenOn('create'),
                Forms\Components\TextInput::make('route')
                    ->label('Route')
                    ->required()
                    ->prefix('http://layouter/')
                    ->readOnlyOn('edit'),
                Forms\Components\TextInput::make('description')
                    ->label('Description'),
                Select::make('layoutId')
                    ->label('Select Layout')
                    ->relationship('layouts', 'name')
                    ->required()
                    ->hiddenOn('edit')
                    ->columnSpanFull(),
                Select::make('headerId')
                    ->hiddenOn('edit')
                    ->required()
                    ->label('Select Header')
                    ->relationship('headers', 'name'),
                Select::make('footerId')
                    ->hiddenOn('edit')
                    ->required()
                    ->label('Select Footer')
                    ->relationship('footers', 'name'),
                Forms\Components\TextArea::make('viewScript')
                    ->label('View Script')
                    ->columnSpanFull()
                    ->hiddenOn('create'),
                Forms\Components\TextArea::make('jsScript')
                    ->label('Javascript Script')
                    ->columnSpanFull()
                    ->hiddenOn('create'),
                Forms\Components\TextArea::make('cssScript')
                    ->label('Css Script')
                    ->columnSpanFull()
                    ->hiddenOn('create'),
                Forms\Components\TextInput::make('viewLocation')
                    ->label('View Location')
                    ->readOnlyOn('edit')
                    ->hiddenOn('create'),
                Forms\Components\TextInput::make('resourceLocation')
                    ->label('Resource Location')
                    ->readOnlyOn('edit')
                    ->hiddenOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label("Categories")
                    ->sortable(),
                TextColumn::make('code')
                    ->label("Table Name")
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListPostCategories::route('/'),
            'create' => Pages\CreatePostCategory::route('/create'),
            'edit' => Pages\EditPostCategory::route('/{record}/edit'),
        ];
    }
}
