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
    protected $signature = 'make:route {name} {route}';

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
        $formatName = strtolower(preg_replace('/(?<!^)(?=[A-Z])/', '-', $name));
        $route = $this->argument('route');
        $routeContent = "Route::get('/$route', function () { return view('$formatName', ['data' => Pages::where('Route', '$route')->first()]); });\n";

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
