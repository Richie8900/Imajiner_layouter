<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\File;

class DatabaseScriptDataSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:database {destination} {model} {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to sync script data to database or database data to script';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $destination = $this->argument('destination');
        $model = $this->argument('model');

        if (!File::exists(app_path('Models/' . $model . '.php'))) {
            $this->error('Model file not found');
            return;
        }

        $model = 'App\Models\\' . $model;

        $items = $model::all();
        $this->info($items);

        // if ($this->argument('direction') == 'database') {
        //     File::get($scriptPath);
        // } else if ($this->argument('direction') == 'script') {
        // } else {
        //     return;
        // }
    }
}
