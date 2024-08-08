<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\DB;
use App\Models;

class testing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:testing {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $name = $this->argument('name');
        // $model = 'App\Models\\' . $name;
        // $this->info($model::all());

        $page = Models\Pages::where('route', 'a')->get();
        $this->info(count($page));
    }
}
