<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\File;

class DeleteFilamentResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:filament-resource {name}';

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
        $resourcePath = app_path('Filament/Resources/' . $name . 'Resource.php');
        $resourceCrudPath = app_path('Filament/Resources/' . $name . 'Resource/Pages');
        // check if path exists
        if (!File::exist($resourcePath)) {
            $this->error('Resource file does not exist');
            return;
        }
        if (!File::exist($resourceCrudPath)) {
            $this->error('Resource file does not exist');
            return;
        }

        // delete
        File::delete($resourcePath);
        // Delete all files in the directory
        $files = File::files($resourceCrudPath);
        foreach ($files as $file) {
            File::delete($file);
            $this->info("The directory $file deleted.");
        }

        $this->info('Filament Resource deleted successfully');
    }
}
