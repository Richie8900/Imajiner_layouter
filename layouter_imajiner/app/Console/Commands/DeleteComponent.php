<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Str;

class DeleteComponent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:component {category} {name}';

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
        $category = $this->argument('category');
        $formattedName = str_replace(' ', '', ucwords($name));
        $slug = Str::slug(preg_replace('/(?<!^)([A-Z])/', ' $1', $name));
        $viewDirectory = resource_path("views/components/$category/$slug.blade.php");
        $appDirectory = app_path("View/Components/$category/$formattedName.php");

        // Check if the directory exists
        if (!File::exists($viewDirectory) || !File::exists($appDirectory)) {
            $this->error("The view component $name does not exist.");
            return;
        } else {
            // Delete file if exist
            File::delete($viewDirectory);
            File::delete($appDirectory);
            $this->info("The view component $name has been deleted successfully.");
            return;
        }
    }
}
