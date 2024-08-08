<?php

namespace App\Console\Commands;

use Filament\Support\Assets\Css;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateStaticFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:static {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a static CSS or JavaScript file in public/static/';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        $directory = public_path('static/' . $name . '-resource');

        // Ensure the directory exists
        if (File::exists($directory)) {
            $this->info(File::exists($directory));
            $this->error("Directory {$directory} already exists.");
            return;
        } else {
            File::makeDirectory($directory, 0755, true);
        }

        // Create the file
        if (preg_match('/\//', $name)) {
            $name2 = explode('/', $name)[1];
        } else {
            $name2 = $name;
        }

        $cssPath = $directory . "/{$name2}.css";
        $jsPath = $directory . "/{$name2}.js";

        if (File::exists($cssPath) && File::exists($jsPath)) {
            $this->error("File {$name2} already exists.");
            return;
        }

        // Create the file with a basic structure based on type
        File::put($cssPath, "/* Styles for {$name2} */\n");
        File::put($jsPath, "// Script for {$name2}\n");

        $this->info("JS and CSS file for {$name2} created successfully in public/static/");
    }
}
