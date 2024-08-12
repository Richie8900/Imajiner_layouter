<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ConfigureModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'configure:model {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Modifies the content of model file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $code = $this->argument('name');

        // make model and migration file
        Artisan::call('make:model', [
            'name' => $code,
            '--migration' => true,
        ]);

        // assigns and checks path
        $modelPath = app_path('Models/' . $code);
        if (!File::exists($modelPath)) {
            $this->error("Model does not exist: " . $modelPath);
        }
        $migrationPath = database_path('migrations/');
        $files = File::files($migrationPath);
        $migrationPath = $files[count($files) - 1];


        // generate script
        $modelScript = "<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Artisan;

class " . $code . " extends Model
{
    use HasFactory;

    protected " . '$table' . " = '" . $code . "';

    protected " . '$fillable' . " = [
        'title',
        'content',
    ];

    protected " . '$casts' . " = [
        'content' => 'array'
    ];
}";

        $migrationScript = "<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('" . $code . "', function (Blueprint " . '$table' . ") {
            " . '$table->id();
            $table->string(\'title\');
            $table->string(\'slug\');
            $table->longText(\'content\')->nullable();
            $table->timestamps();' . "
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('" . $code . "');
    }
};
";
        // replace script
        File::put($modelPath, $modelScript);
        File::put($migrationPath, $migrationScript);

        $this->info($migrationPath);
    }
}
