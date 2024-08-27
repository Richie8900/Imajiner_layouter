<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Header;
use App\Models\Footer;
use App\Models\Component;
use App\Models\Layout;
use App\Models\Pages;
use App\Models\PostCategory;
use Illuminate\Support\Facades\File;

class DataSyncController extends Controller
{
    public static function syncComponent($id, $isFromScript)
    {
        // $isFromScript -> is it syncing from script to db?
        $data = Component::find($id);
        if ($data != null) {
            if (File::exists(resource_path($data['viewLocation'])) && File::exists(public_path($data['resourceLocation']))) {
                if ($isFromScript) {
                    $script = File::get(resource_path($data['viewLocation']));
                    $data['viewScript'] = $script;

                    $jsScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".js");
                    $data['jsScript'] = $jsScript;

                    $cssScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".css");
                    $data['cssScript'] = $cssScript;
                    $data->save();
                } else {
                    File::put(resource_path($data['viewLocation']), $data['viewScript']);
                    $cssPath = public_path($data['resourceLocation'] . "/" . $data['slug'] . ".css");
                    $jsPath = public_path($data['resourceLocation'] .  "/" . $data['slug'] . ".js");
                    File::put($cssPath, $data['cssScript']);
                    File::put($jsPath, $data['jsScript']);
                }
            }
        }
    }

    public static function syncHeader($id, $isFromScript)
    {
        $data = Header::find($id);
        if ($data != null) {
            if (File::exists(resource_path($data['viewLocation'])) && File::exists(public_path($data['resourceLocation']))) {
                if ($isFromScript) {
                    $script = File::get(resource_path($data['viewLocation']));
                    $data['viewScript'] = $script;

                    $jsScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".js");
                    $data['jsScript'] = $jsScript;

                    $cssScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".css");
                    $data['cssScript'] = $cssScript;
                    $data->save();
                } else {
                    File::put(resource_path($data['viewLocation']), $data['viewScript']);
                    $cssPath = public_path($data['resourceLocation'] . "/" . $data['slug'] . ".css");
                    $jsPath = public_path($data['resourceLocation'] .  "/" . $data['slug'] . ".js");
                    File::put($cssPath, $data['cssScript']);
                    File::put($jsPath, $data['jsScript']);
                }
            }
        }
    }

    public static function syncFooter($id, $isFromScript)
    {
        $data = Footer::find($id);
        if ($data != null) {
            if (File::exists(resource_path($data['viewLocation'])) && File::exists(public_path($data['resourceLocation']))) {
                if ($isFromScript) {
                    $script = File::get(resource_path($data['viewLocation']));
                    $data['viewScript'] = $script;

                    $jsScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".js");
                    $data['jsScript'] = $jsScript;

                    $cssScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".css");
                    $data['cssScript'] = $cssScript;
                    $data->save();
                } else {
                    File::put(resource_path($data['viewLocation']), $data['viewScript']);
                    $cssPath = public_path($data['resourceLocation'] . "/" . $data['slug'] . ".css");
                    $jsPath = public_path($data['resourceLocation'] .  "/" . $data['slug'] . ".js");
                    File::put($cssPath, $data['cssScript']);
                    File::put($jsPath, $data['jsScript']);
                }
            }
        }
    }

    public static function syncLayout($id, $isFromScript)
    {
        $data = Layout::find($id);
        if ($data != null) {
            if (File::exists(resource_path($data['viewLocation'])) && File::exists(public_path($data['resourceLocation']))) {
                if ($isFromScript) {
                    $script = File::get(resource_path($data['viewLocation']));
                    $data['viewScript'] = $script;

                    $jsScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".js");
                    $data['jsScript'] = $jsScript;

                    $cssScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".css");
                    $data['cssScript'] = $cssScript;
                    $data->save();
                } else {
                    File::put(resource_path($data['viewLocation']), $data['viewScript']);
                    $cssPath = public_path($data['resourceLocation'] . "/" . $data['slug'] . ".css");
                    $jsPath = public_path($data['resourceLocation'] .  "/" . $data['slug'] . ".js");
                    File::put($cssPath, $data['cssScript']);
                    File::put($jsPath, $data['jsScript']);
                }
            }
        }
    }

    public static function syncPage($id, $isFromScript)
    {
        $data = Pages::find($id);
        if ($data != null) {
            if (File::exists(resource_path($data['viewLocation'])) && File::exists(public_path($data['resourceLocation']))) {
                if ($isFromScript) {
                    $script = File::get(resource_path($data['viewLocation']));
                    $data['viewScript'] = $script;

                    $jsScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".js");
                    $data['jsScript'] = $jsScript;

                    $cssScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".css");
                    $data['cssScript'] = $cssScript;
                    $data->save();
                } else {
                    File::put(resource_path($data['viewLocation']), $data['viewScript']);
                    $cssPath = public_path($data['resourceLocation'] . "/" . $data['slug'] . ".css");
                    $jsPath = public_path($data['resourceLocation'] .  "/" . $data['slug'] . ".js");
                    File::put($cssPath, $data['cssScript']);
                    File::put($jsPath, $data['jsScript']);
                }
            }
        }
    }

    public static function syncPostCategory($id, $isFromScript)
    {
        $data = PostCategory::find($id);
        if ($data != null) {
            if (File::exists(resource_path($data['viewLocation'])) && File::exists(public_path($data['resourceLocation']))) {
                if ($isFromScript) {
                    $script = File::get(resource_path($data['viewLocation']));
                    $data['viewScript'] = $script;

                    $jsScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".js");
                    $data['jsScript'] = $jsScript;

                    $cssScript = File::get(public_path($data['resourceLocation']) . "/" . $data['slug'] . ".css");
                    $data['cssScript'] = $cssScript;
                    $data->save();
                } else {
                    File::put(resource_path($data['viewLocation']), $data['viewScript']);
                    $cssPath = public_path($data['resourceLocation'] . "/" . $data['slug'] . ".css");
                    $jsPath = public_path($data['resourceLocation'] .  "/" . $data['slug'] . ".js");
                    File::put($cssPath, $data['cssScript']);
                    File::put($jsPath, $data['jsScript']);
                }
            }
        }
    }
}
