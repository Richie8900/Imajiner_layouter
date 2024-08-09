<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayoutResource\Pages;
use App\Filament\Resources\LayoutResource\RelationManagers;
use App\Models\Layout;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Repeater;

use App\Models\Pages as PagesModel;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;

class LayoutResource extends Resource
{
    protected static ?string $model = Layout::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Layouter';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Layout Name')
                    ->required()
                    ->readOnlyOn('edit'),
                Forms\Components\TextInput::make('slug')
                    ->label('Tag')
                    ->readOnlyOn('edit')
                    ->hiddenOn('create'),
                Forms\Components\TextInput::make('description')
                    ->label('Description')
                    ->columnSpanFull(),
                Repeater::make('content')
                    ->label('Content')
                    ->schema([
                        Forms\Components\TextInput::make('title'),
                        Forms\Components\Textarea::make('description'),
                    ])
                    ->columnSpanFull(),
                Forms\Components\TextArea::make('viewScript')
                    ->label('View Script')
                    ->columnSpanFull(),
                Forms\Components\TextArea::make('jsScript')
                    ->label('Javascript Script')
                    ->columnSpanFull(),
                Forms\Components\TextArea::make('cssScript')
                    ->label('Css Script')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('viewLocation')
                    ->label('View Location')
                    ->readOnlyOn('edit')
                    ->hiddenOn('create'),
                Forms\Components\TextInput::make('resourceLocation')
                    ->label('Resource Location')
                    ->readOnlyOn('edit')
                    ->hiddenOn('create'),
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('Preview edit from Script')
                        ->action('redirectToPreview')
                ])
                    ->hiddenOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label("Layout name")
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
            'index' => Pages\ListLayouts::route('/'),
            'create' => Pages\CreateLayout::route('/create'),
            'edit' => Pages\EditLayout::route('/{record}/edit'),
        ];
    }
}
