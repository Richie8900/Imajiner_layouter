<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateNewRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:route {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new route in web.php';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $routeContent = "Route::get('/$name', function () { return view('$name', ['data' => Pages::where('Route', '$name')->first()]); });\n";

        $path = base_path('routes/web.php');

        if (!File::exists($path)) {
            $this->error("The file web.php does not exist.");
            return;
        }

        // Append the new route to web.php
        File::append($path, $routeContent);

        $this->info("Route /$name created successfully in web.php.");
    }
}
