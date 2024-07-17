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
        $routeContent = "Route::get('/$name', function () { return '$name route'; });\n";

        $path = base_path('routes/web.php');

        // Append the new route to web.php
        File::append($path, $routeContent);

        $this->info("Route /$name created successfully in web.php.");
    }
}
