<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PagesResource\Pages;
use App\Filament\Resources\PagesResource\RelationManagers;
use App\Models\Pages as ModelPage;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

use Filament\Forms\Components\Repeater;

class PagesResource extends Resource
{
    protected static ?string $model = ModelPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Layouter';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Page Name')
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
                // ->readOnlyOn('edit'),
                ,
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
                Repeater::make('content')
                    ->label('Content')
                    ->schema([
                        Forms\Components\TextInput::make('title'),
                        Forms\Components\Textarea::make('description'),
                    ])
                    ->columnSpanFull(),
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
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('Sync script with database')
                        ->action('sync_script_with_db'),
                ])
                    ->hiddenOn('create'),
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('Sync database with script')
                        ->action('sync_db_with_script')
                ])
                    ->hiddenOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label("Header name")
                    ->sortable(),
                TextColumn::make('description')
                    ->label("Description")
                    ->sortable(),
                TextColumn::make('slug')
                    ->label("Tag")
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePages::route('/create'),
            'edit' => Pages\EditPages::route('/{record}/edit'),
        ];
    }
}
