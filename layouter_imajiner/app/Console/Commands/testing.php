<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\DB;
use App\Models;
use App\Models\Post_ModelAsd;

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
        // $this->info(Post_ModelAsd::all());
        // $a = public_path('static/postCategory' . $this->argument('a'));
        // File::deleteDirectories($a);
        $this->info(File::exists(storage_path('app/public/uploads/yesterday.jpg')));
        $this->info(storage_path('app/public/uploads/yesterday.jpg'));
        // if (FIle::exists(asset('uploads/yesterday'))) {
        // File::delete(asset($record->path));
        // }
    }
}
