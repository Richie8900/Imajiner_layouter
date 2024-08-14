<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
    protected $description = 'Used to delete filament resource files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $name = Str::ucfirst($name);
        $resourcePath = app_path('Filament/Resources/' . $name . 'Resource.php');
        $resourceCrudPath = app_path('Filament/Resources/' . $name . 'Resource/Pages');
        // check if path exists
        if (!File::exists($resourcePath)) {
            $this->error('Resource file does not exist');
            return;
        }
        if (!File::exists($resourceCrudPath)) {
            $this->error('Resource file does not exist');
            return;
        }

        // delete
        File::delete($resourcePath);
        // Delete all files in the directory
        $files = File::files($resourceCrudPath);
        foreach ($files as $file) {
            File::delete($file);
        }
        // delete leftover directory
        File::deleteDirectory($resourceCrudPath);
        File::deleteDirectory(app_path('Filament/Resources/' . $name . 'Resource'));

        $this->info('Filament Resource deleted successfully');
    }
}
