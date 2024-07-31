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
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        } else {
            File::makeDirectory($directory, 0755, true);
        }

        // Create the file
        $cssPath = $directory . "/{$name}.css";
        $jsPath = $directory . "/{$name}.js";

        if (File::exists($cssPath) || File::exists($jsPath)) {
            $this->error("File {$name} already exists.");
            return;
        }

        // Create the file with a basic structure based on type
        File::put($cssPath, "/* Styles for {$name} */\n");
        File::put($jsPath, "// Script for {$name}\n");

        $this->info("JS and CSS file for {$name} created successfully in public/static/");
    }
}
