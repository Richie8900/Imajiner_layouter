<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Header;
use App\Models\Footer;
use App\Models\Component;
use App\Models\Layout;
use App\Models\Pages;
use App\Models\PostCategory;
use Filament\Pages\Page;
use Illuminate\Support\Facades\File;

class DataSyncController extends Controller
{
    public static function syncHeader($id)
    {
        $data = Header::find($id);
        if ($data != null) {
            if (File::exists(resource_path($data['viewLocation'])) && File::exists(public_path($data['resourceLocation']))) {
                $script = File::get(resource_path($data['viewLocation']));
                $data['viewScript'] = $script;

                $jsScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".js");
                $data['jsScript'] = $jsScript;

                $cssScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".css");
                $data['cssScript'] = $cssScript;

                $data->save();
            }
        }
    }

    public static function syncFooter($id)
    {
        $data = Footer::find($id);
        if ($data != null) {
            if (File::exists(resource_path($data['viewLocation'])) && File::exists(public_path($data['resourceLocation']))) {
                $script = File::get(resource_path($data['viewLocation']));
                $data['viewScript'] = $script;

                $jsScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".js");
                $data['jsScript'] = $jsScript;

                $cssScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".css");
                $data['cssScript'] = $cssScript;

                $data->save();
            }
        }
    }

    public static function syncComponent($id)
    {
        $data = Component::find($id);
        if ($data != null) {
            if (File::exists(resource_path($data['viewLocation'])) && File::exists(public_path($data['resourceLocation']))) {
                $script = File::get(resource_path($data['viewLocation']));
                $data['viewScript'] = $script;

                $jsScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".js");
                $data['jsScript'] = $jsScript;

                $cssScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".css");
                $data['cssScript'] = $cssScript;

                $data->save();
            }
        }
    }

    public static function syncLayout($id)
    {
        $data = Layout::find($id);
        if ($data != null) {
            if (File::exists(resource_path($data['viewLocation'])) && File::exists(public_path($data['resourceLocation']))) {
                $script = File::get(resource_path($data['viewLocation']));
                $data['viewScript'] = $script;

                $jsScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".js");
                $data['jsScript'] = $jsScript;

                $cssScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".css");
                $data['cssScript'] = $cssScript;

                $data->save();
            }
        }
    }

    public static function syncPage($id)
    {
        $data = Page::find($id);
        if ($data != null) {
            if (File::exists(resource_path($data['viewLocation'])) && File::exists(public_path($data['resourceLocation']))) {
                $script = File::get(resource_path($data['viewLocation']));
                $data['viewScript'] = $script;

                $jsScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".js");
                $data['jsScript'] = $jsScript;

                $cssScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".css");
                $data['cssScript'] = $cssScript;

                $data->save();
            }
        }
    }

    public static function syncPostCategory($id)
    {
        $data = PostCategory::find($id);
        if ($data != null) {
            if (File::exists(resource_path($data['viewLocation'])) && File::exists(public_path($data['resourceLocation']))) {
                $script = File::get(resource_path($data['viewLocation']));
                $data['viewScript'] = $script;

                $jsScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".js");
                $data['jsScript'] = $jsScript;

                $cssScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".css");
                $data['cssScript'] = $cssScript;

                $data->save();
            }
        }
    }
}
