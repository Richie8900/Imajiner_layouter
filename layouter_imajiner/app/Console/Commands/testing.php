<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class testing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:testing';

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
        $a = File::exists(resource_path('views/components/header/header-one.blade.php'));
        $info = "";

        if ($a) {
            $info = "info";
        } else {
            $info = "error";
        };

        $this->info($info);
    }
}
