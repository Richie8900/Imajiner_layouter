<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Artisan;
use App\Models\Component;
use App\Models\Header;
use App\Models\Footer;
use App\Models\Layout;
use App\Models\Media;
use App\Models\Pages;
use App\Models\PostCategory;

class Rebirth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rebirth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to reset and clear all of layouter data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // deletes all the data 100 at a time
        Pages::chunk(100, function ($records) {
            foreach ($records as $record) {
                $record->delete();
            }
        });
        $this->info("Pages cleaned");
        PostCategory::chunk(100, function ($records) {
            foreach ($records as $record) {
                $record->delete();
            }
        });
        $this->info("PostCategory cleaned");
        Component::chunk(100, function ($records) {
            foreach ($records as $record) {
                $record->delete();
            }
        });
        $this->info("Component cleaned");
        Header::chunk(100, function ($records) {
            foreach ($records as $record) {
                $record->delete();
            }
        });
        $this->info("Header cleaned");
        Footer::chunk(100, function ($records) {
            foreach ($records as $record) {
                $record->delete();
            }
        });
        $this->info("Footer cleaned");
        Layout::chunk(100, function ($records) {
            foreach ($records as $record) {
                $record->delete();
            }
        });
        $this->info("Layout cleaned");
        Media::chunk(100, function ($records) {
            foreach ($records as $record) {
                $record->delete();
            }
        });
        $this->info("Media cleaned");
        $this->info("Rebirth complete");
    }
}
