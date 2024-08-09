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
        $jsonString = '[{"title":"1","description":"2"},{"title":"ss","description":"sdsds"}]';
        $dataArray = json_decode($jsonString, true); // true for associative array
        // This assumes $dataArray is already an array of associative arrays
        $dataArray = [
            ["title" => "1", "description" => "2"],
            ["title" => "ss", "description" => "sdsds"]
        ];

        $formattedArray = [];

        foreach ($dataArray as $item) {
            // Use the 'title' as the key and 'description' as the value
            $formattedArray[$item['title']] = $item['description'];
        }

        // Print the result
        // print_r($formattedArray);


        $this->info($formattedArray['1'] . $formattedArray['ss']);
    }
}
