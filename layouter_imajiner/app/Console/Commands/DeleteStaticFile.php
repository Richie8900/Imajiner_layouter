<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeleteStaticFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:static {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes static files from the specified folder in public/static';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $directoryPath = public_path("static/$name-resource");

        // Check if the directory exists
        if (!File::exists($directoryPath)) {
            $this->error("The directory $directoryPath does not exist.");
            return;
        }

        // Delete all files in the directory
        $files = File::files($directoryPath);
        foreach ($files as $file) {
            File::delete($file);
            $this->info("The directory $file deleted.");
        }


        // Delete the directory and all its contents
        if (File::deleteDirectory($directoryPath)) {
            $this->info("The directory $directoryPath and all its contents have been deleted successfully.");
        } else {
            $this->error("Failed to delete the directory $directoryPath.");
        }
    }
}
