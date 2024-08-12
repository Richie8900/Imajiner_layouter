<?php

namespace App\Filament\Resources\PostCategoryResource\Pages;

use App\Filament\Resources\PostCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use App\Models\PostCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;

use App\Models\Layout;
use App\Models\Header;
use App\Models\Footer;

use Illuminate\Support\Carbon;

class CreatePostCategory extends CreateRecord
{
    protected static string $resource = PostCategoryResource::class;

    // redirect to index page
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        //         // create tag name n location
        // $data['slug'] = Str::slug($data['name']);
        $formattedName = str_replace(' ', '', ucwords($data['name']));
        // -> Post_AsdAsd -> PostAsdAsd

        //         // create view, javascript, and css using artisan
        //         Artisan::call('make:view', [
        //             'name' => 'postCategory/' . $data['slug'] . '-view/' . $data['slug'],
        //         ]);

        //         Artisan::call('make:static', [
        //             'name' => 'postCategory/' . $data['slug'] . '-view/' . $data['slug'],
        //         ]);

        //         $data['viewLocation'] = "views/postCategory/" . $data['slug'] . '-view/' . $data['slug'] . ".blade.php";
        //         $data['resourceLocation'] = "static/postCategory/" . $data['slug'] . '-view/' . $data['slug'] . "-resource";
        //         $cssPath = $data['resourceLocation'] . "/" . $data['slug'] . ".css";
        //         $jsPath = $data['resourceLocation'] .  "/" . $data['slug'] . ".js";

        //         $layoutTagName = Layout::find($data['layoutId'])->slug;
        //         $layoutTagOpen = "<x-layout." . $layoutTagName . ">";
        //         $layoutTagClose = "</x-layout." . $layoutTagName . ">";
        //         $headerTag = "";
        //         if ($data['headerId'] != null) {
        //             $headerTagName = Header::find($data['headerId'])->slug;
        //             $headerTag = "<x-header." . $headerTagName . "/>";
        //         }
        //         $footerTag = "";
        //         if ($data['footerId'] != null) {
        //             $footerTagName = Footer::find($data['footerId'])->slug;
        //             $footerTag = "<x-footer." . $footerTagName . "/>";
        //         }

        //         // structuring the script
        //         $data['viewScript'] =
        //             "$layoutTagOpen
        //     $headerTag
        //     <link rel=\"stylesheet\" href=\"{{ asset('static/{$data['slug']}-resource/{$data['slug']}.css') }}\">

        //     {{-- Content here --}}

        //     <script src=\"{{ asset('static/{$data['slug']}-resource/{$data['slug']}.js') }}\"></script>
        //     $footerTag
        // $layoutTagClose";

        //         // put script into the view file
        //         File::put(resource_path($data['viewLocation']), $data['viewScript']);

        // generate Code
        $data['code'] = 'Post' . $formattedName;
        $formatName = str_replace(' ', '', ucwords(str_replace('_', ' ', $data['code'])));

        // create model
        Artisan::call('configure:model', [
            'name' => $data['code']
        ]);

        // create filament resource
        Artisan::call('configure:filament', [
            'name' => $data['code']
        ]);

        return $data;
    }
}
