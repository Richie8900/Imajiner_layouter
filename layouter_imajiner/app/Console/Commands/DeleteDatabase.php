<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class DeleteDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:database {name} {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Used to delete model file, migration file, and database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $migrationPath = database_path($this->argument('path'));
        $modelPath = app_path('Models/' . $name . '.php');

        // delete database
        try {
            Schema::dropIfExists($name);
        } catch (\Exception $e) {
            $this->error("Failed to delete the database: " . $e->getMessage());
            return;
        }

        // check if path exists
        if (!File::exists($modelPath)) {
            $this->error('Model not found: ' . $modelPath);
            return;
        }
        if (!File::exists($migrationPath)) {
            $this->error('Migration not found: ' . $migrationPath);
            return;
        }

        // delete migration file and model
        File::delete($migrationPath);
        File::delete($modelPath);

        $this->info('Database, Model, and Migration deleted successfully');
    }
}
