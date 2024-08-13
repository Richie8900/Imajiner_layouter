<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class ConfigureFilamentResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'configure:filament {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Modifies the content of filament files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $code = $this->argument('name');

        // make model and migration file
        Artisan::call('make:filament-resource', [
            'name' => $code,
        ]);

        // assigns script to path
        $resourcePath = app_path('Filament/Resources/' . $code . 'Resource.php');
        $cPath = app_path('Filament/Resources/' . $code . 'Resource/Pages/Create' . $code . '.php');
        $ePath = app_path('Filament/Resources/' . $code . 'Resource/Pages/Edit' . $code . '.php');

        // generate script
        $resourceScript = "<?php

namespace App\Filament\Resources;

use App\Filament\Resources\\" . $code . "Resource\Pages;
use App\Filament\Resources\\" . $code . "Resource\RelationManagers;
use App\Models\\" . $code . ";
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;

class " . $code . " extends Resource
{
    protected static ?string \$model = " . $code . "::class;

    protected static ?string \$navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string \$navigationGroup = 'Categories';

    public static function form(Form \$form): Form
    {
        return \$form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required(),
                Repeater::make('content')
                    ->label('Content')
                    ->schema([
                        Forms\Components\TextInput::make('title'),
                        Forms\Components\Textarea::make('description'),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table \$table): Table
    {
        return \$table
            ->columns([
                TextColumn::make('title')
                    ->label(\"Title\")
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
            'index' => Pages\List" . $code . "::route('/'),
            'create' => Pages\Create" . $code . "::route('/create'),
            'edit' => Pages\Edit" . $code . "::route('/{record}/edit'),
        ];
    }
}";

        // replace script
        File::put($resourcePath, $resourceScript);

        $this->info($code);
    }
}
