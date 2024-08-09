<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\File;

class DeletePostView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-post-view';

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
        // $dir = $this->argument('directory');
        $viewPath = resource_path("views/$name.blade.php");
        // if ($dir != 'view') {
        //     $viewPath = resource_path("views/$dir/$name.blade.php");
        // }

        // Check if the directory exists
        if (!File::exists($viewPath)) {
            $this->error("The directory $viewPath does not exist.");
            return;
        }

        // // Delete all files in the directory
        // if ($dir != "view") {
        //     $files = File::files($$viewPath);
        //     foreach ($files as $file) {
        //         File::delete($file);
        //         $this->info("The directory $file deleted.");
        //     }
        // }
        File::delete($viewPath);
        $this->info("The view component $name has been deleted successfully.");
    }
}
