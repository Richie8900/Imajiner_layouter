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
    protected $signature = 'app:delete-static-file';

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
        $directoryPath = public_path("static/$name");

        if (!File::exists($directoryPath)) {
            $this->error("The directory $directoryPath does not exist.");
            return;
        }

        $files = File::files($directoryPath);

        if (empty($files)) {
            $this->info("No files found in the directory $directoryPath.");
            return;
        }

        foreach ($files as $file) {
            File::delete($file);
        }

        $this->info("All files in the directory $directoryPath have been deleted successfully.");
    }
}
