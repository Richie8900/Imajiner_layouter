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

use App\Models\Pages as PagesModel;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;

class FooterResource extends Resource
{
    protected static ?string $model = Footer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextArea::make('FooterName')
                    ->label('Footer name')
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
                TextColumn::make('FooterName')
                    ->label("Footer name")
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
                    ->before(function ($record, Tables\Actions\DeleteAction $action) {
                        // Check if the Header record is referenced by any Page record
                        $isReferenced = PagesModel::where('FooterId', $record->id)->exists();

                        if ($isReferenced) {
                            // Use Filament's notification system to display an error message
                            Notification::make()
                                ->title('Deletion Failed')
                                ->danger()
                                ->body('This footer is referenced in the Pages table and cannot be deleted.')
                                ->send();

                            // Prevent the deletion from proceeding
                            $action->cancel();
                        }
                    })
                    ->after(function ($record, $action) {
                        // Deletes the component files using artisan command
                        Artisan::call('delete:component', [
                            'type' => 'Footer',
                            'name' => $record->FooterName,
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
            'index' => Pages\ListFooters::route('/'),
            'create' => Pages\CreateFooter::route('/create'),
            'edit' => Pages\EditFooter::route('/{record}/edit'),
        ];
    }
}
