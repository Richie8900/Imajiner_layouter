<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Contracts\View\View;
use App\Models\Pages;
use App\Models\PostCategory;

class RouteController extends Controller
{
    public function getStaticRoute(string $slug): view
    {
        $page = Pages::where('route', $slug)->get();

        if (count($page) == 0) {
            abort(404);
        }

        return view($page[0]['slug'], ['data' => $page[0]]);
    }

    public function getDynamicRoute(string $category, string $title): view
    {
        $category = PostCategory::where('route', $category)->get();

        if (count($category) == 0) {
            abort(404);
        }

        $postClass = 'App\Models\\' . $category[0]['slug'];
        $post = $postClass::where('title', $title)->get();

        if (count($post) == 0) {
            abort(404);
        }

        return view("{$category[0]['slug']}/{$post[0]['slug']}", ['data' => $post[0]]);
    }
}
