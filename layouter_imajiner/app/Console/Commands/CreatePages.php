<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CreatePages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:page {name} {script}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create page from specified script';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $name = $this->argument('name');
        // $script = $this->argument('script');

        // Artisan::call('make:view', [
        //     'name' => $name,
        // ]);

        // $directory = resource_path('views');


    }
}
