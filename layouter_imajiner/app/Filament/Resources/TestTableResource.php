<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestTableResource\Pages;
use App\Filament\Resources\TestTableResource\RelationManagers;
use App\Models\TestTable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Artisan;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use App\Models\Pages as PagesModel;

class TestTableResource extends Resource
{
    protected static ?string $model = TestTable::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextArea::make('LayoutName')
                    ->label('Layout name')
                    ->required(),
                Forms\Components\TextArea::make('Script')
                    ->label('Script')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('LayoutName')
                    ->label("Layout name")
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
                        // Check if the TestTable record is referenced by any Page record
                        $isReferenced = PagesModel::where('LayoutId', $record->id)->exists();

                        if ($isReferenced) {
                            // Use Filament's notification system to display an error message
                            Notification::make()
                                ->title('Deletion Failed')
                                ->danger()
                                ->body('This layout is referenced in the Pages table and cannot be deleted.')
                                ->send();

                            // Prevent the deletion from proceeding
                            $action->cancel();
                        }
                    })
                    ->after(function ($record, $action) {
                        // Deletes the component files using artisan command
                        Artisan::call('delete:component', [
                            'type' => 'Layout',
                            'name' => $record->LayoutName,
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
            'index' => Pages\ListTestTables::route('/'),
            'create' => Pages\CreateTestTable::route('/create'),
            'edit' => Pages\EditTestTable::route('/{record}/edit'),
        ];
    }
}
