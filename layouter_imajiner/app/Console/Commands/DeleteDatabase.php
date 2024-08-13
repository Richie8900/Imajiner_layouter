<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $migrationPath = $this->argument('path');
        $modelPath = app_path('Models/' . $name . '.php');

        // delete database
        try {
            // Change to the default database connection
            Config::set('database.connections.mysql.database', null);
            DB::purge('mysql');
            DB::reconnect('mysql');

            // Drop the database
            DB::statement("DROP DATABASE IF EXISTS $name");

            $this->info("Database '$name' deleted successfully.");
        } catch (\Exception $e) {
            $this->error("Failed to delete the database: " . $e->getMessage());
        }

        // check if path exists
        if (!File::exists(database_path($migrationPath))) {
            $this->error('Migration not found: ' . $migrationPath);
            return;
        }
        if (!File::exists($modelPath)) {
            $this->error('Model not found: ' . $modelPath);
            return;
        }

        // delete migration file and model
        File::delete($migrationPath);
        File::delete($modelPath);

        $this->info('Database, Model, and Migration deleted successfully');
    }
}
