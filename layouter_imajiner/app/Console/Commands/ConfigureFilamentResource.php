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
    protected $signature = 'configure:filament {name} {code} {route}';

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
        $code = $this->argument('code');
        $name = $this->argument('name');
        $route = $this->argument('route');

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

class " . $code . "Resource extends Resource
{
    protected static ?string \$model = " . $code . "::class;

    protected static ?string \$navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string \$navigationLabel  = '" . $name . "';
    protected static ?string \$navigationGroup = 'Post Categories';

    public static function form(Form \$form): Form
    {
        return \$form
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

    public static function table(Table \$table): Table
    {
        return \$table
            ->columns([
                TextColumn::make('title')
                    ->label(\"Title\")
                    ->sortable(),
                TextColumn::make('slug')
                    ->label(\"Route\")
                    ->prefix('" . $route . "/')
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
            'index' => Pages\List" . $code . "::route('/'),
            'create' => Pages\Create" . $code . "::route('/create'),
            'edit' => Pages\Edit" . $code . "::route('/{record}/edit'),
        ];
    }
}";

        $cScript = "<?php

namespace App\Filament\Resources\\" . $code . "Resource\Pages;

use App\Filament\Resources\\" . $code . "Resource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Str;
use Filament\Notifications\Notification;
use App\Models\\" . $code . ";

class Create" . $code . " extends CreateRecord
{
    protected static string \$resource = " . $code . "Resource::class;

    // redirect to index page
    protected function getRedirectUrl(): string
    {
        return \$this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array \$data): array
    {
        \$data['slug'] = Str::slug(\$data['title']);

        // validation route
        \$p = " . $code . "::where('title', \$data['title']);
        if (count(\$p->get()) != 0) {
            Notification::make()
                ->title('Creation Cancelled')
                ->body(\"Route already in use\")
                ->warning()
                ->send();

            \$this->halt();
        }

        return \$data;
    }
}";

        // replace script
        File::put($resourcePath, $resourceScript);
        File::put($cPath, $cScript);

        $this->info($code);
    }
}
