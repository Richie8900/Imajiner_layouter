<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Header;
use App\Models\Footer;
use App\Models\Component;
use Illuminate\Support\Facades\File;

class DataSyncController extends Controller
{
    public static function syncHeader($id)
    {
        $data = Header::find($id);
        if ($data != null) {
            if (File::exists(resource_path($data['viewLocation']))) {
                $script = File::get(resource_path($data['viewLocation']));
                $data['viewScript'] = $script;
                $data->save();
            }
        }
    }

    public static function syncFooter($id)
    {
        $data = Footer::find($id);
        if ($data != null) {
            if (File::exists(resource_path($data['viewLocation']))) {
                $script = File::get(resource_path($data['viewLocation']));
                $data['viewScript'] = $script;
                $data->save();
            }
        }
    }

    public static function syncComponent($id)
    {
        $data = Component::find($id);
        if ($data != null) {
            if (File::exists(resource_path($data['viewLocation']))) {
                $script = File::get(resource_path($data['viewLocation']));
                $data['viewScript'] = $script;
                $data->save();
            }
        }
    }
}
