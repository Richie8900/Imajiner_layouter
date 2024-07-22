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

class PagesResource extends Resource
{
    protected static ?string $model = ModelPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextArea::make('PageName')
                    ->label('Page name')
                    ->required(),
                Forms\Components\TextArea::make('Description')
                    ->label('Desciption')
                    ->required(),
                // Forms\Components\TextArea::make('Script')
                //     ->label('Script')
                //     ->required(),
                Forms\Components\TextArea::make('Route')
                    ->label('Route (/path, just input the path name)')
                    ->required(),
                Select::make('LayoutId')
                    ->label('Select Layout')
                    ->relationship('test_tables', 'LayoutName')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('PageName')
                    ->label("Page Name")
                    ->sortable(),
                TextColumn::make('Description')
                    ->label("Description")
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function ($record) {
                        // delete route
                        Artisan::call('make:route', [
                            'name' => $record->Route,
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePages::route('/create'),
            'edit' => Pages\EditPages::route('/{record}/edit'),
        ];
    }
}
