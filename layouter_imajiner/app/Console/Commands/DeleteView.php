<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\File;

class DeleteView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:view {name} {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Used to delete view file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $viewPath = resource_path("views/$name.blade.php");

        // Check if the directory exists
        if (!File::exists($viewPath)) {
            $this->error("The directory $viewPath does not exist.");
            return;
        }

        File::delete($viewPath);
        $this->info("The view component $name has been deleted successfully.");
    }
}
