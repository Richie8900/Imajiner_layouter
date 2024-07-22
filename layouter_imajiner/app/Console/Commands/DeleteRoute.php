<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeleteRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:route {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete an existing route in web.php';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $name = $this->argument('name');
        // $routePattern = "Route::get('/$name', function () { return view('$name', ['data' => Pages::where('Route', '$name')->first()]); });\n";

        // $path = base_path('routes/web.php');

        // if (!File::exists($path)) {
        //     $this->error("The file web.php does not exist.");
        //     return;
        // }

        // $fileContents = File::get($path);

        // if (preg_match($routePattern, $fileContents)) {
        //     $updatedContents = preg_replace($routePattern, '', $fileContents);
        //     File::put($path, $updatedContents);
        //     $this->info("Route /$name deleted successfully from web.php.");
        // } else {
        //     $this->info("Route /$name not found in web.php.");
        // }

        {
            $name = $this->argument('name');
            $routePattern = "Route::get('/$name', function () { return view('$name', ['data' => Pages::where('Route', '$name')->first()]); });";

            $path = base_path('routes/web.php');

            if (!File::exists($path)) {
                $this->error("The file web.php does not exist.");
                return;
            }

            $fileContents = File::get($path);
            $lines = explode(PHP_EOL, $fileContents);
            $updatedLines = array_filter($lines, function ($line) use ($routePattern) {
                return trim($line) !== trim($routePattern);
            });

            File::put($path, implode(PHP_EOL, $updatedLines));
            $this->info("Route /$name deleted successfully from web.php.");
        }
    }
}
