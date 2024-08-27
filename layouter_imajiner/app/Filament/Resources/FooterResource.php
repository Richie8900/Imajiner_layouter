<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterResource\Pages;
use App\Filament\Resources\FooterResource\RelationManagers;
use App\Models\Footer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Actions\ButtonAction;
use Illuminate\Support\Facades\Redirect;

use App\Models\Pages as PagesModel;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;

class FooterResource extends Resource
{
    protected static ?string $model = Footer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Layouter';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Footer Name')
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
                    ->label("Footer name")
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
                ButtonAction::make('customButton')
                    ->label('Preview')
                    ->action(function ($record) {
                        $id = $record->id;
                        return Redirect::to("/componentPreview/footer/{$id}");
                    })
                    ->color('primary')
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
            'index' => Pages\ListFooters::route('/'),
            'create' => Pages\CreateFooter::route('/create'),
            'edit' => Pages\EditFooter::route('/{record}/edit'),
        ];
    }
}
