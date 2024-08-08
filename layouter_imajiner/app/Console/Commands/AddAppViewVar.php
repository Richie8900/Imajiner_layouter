<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AddAppViewVar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:appView {data*}';

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
        $var = $this->argument('data');

        $this->info($var[0] . ", " . $var[1] . ", " . $var[2]);
    }
}
