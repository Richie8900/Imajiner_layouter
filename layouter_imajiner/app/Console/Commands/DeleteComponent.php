<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeleteComponent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:component {type} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Used to delete component files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $formatName = strtolower(preg_replace('/(?<!^)(?=[A-Z])/', '-', $name));
        $type = $this->argument('type');
        $viewDirectory = resource_path("views/components/" . strtolower($type) . "/$formatName.blade.php");
        $appDirectory = app_path("View/Components/$type/$name.php");

        // Check if the directory exists
        if (!File::exists($viewDirectory) || !File::exists($appDirectory)) {
            $this->error("The view component $name does not exist.");
            return;
        } else {
            // $this->info("The view component $name has been deleted.");
            // return;
            // Delete file if exist
            File::delete($viewDirectory);
            File::delete($appDirectory);
            $this->info("The view component $name has been deleted successfully.");
            return;
        }
    }
}
