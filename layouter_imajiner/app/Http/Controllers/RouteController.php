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

        $page = $page[0];
        $content = $page->content;

        // reformat content
        $formattedContent = [];
        foreach ($content as $item) {
            $formattedContent[$item['title']] = $item['description'];
        }

        $content = $formattedContent;

        return view($page->slug, ['data' => $page, 'content' => $content]);
    }

    public function getDynamicRoute(string $category, string $title): view
    {
        $category = PostCategory::where('route', $category)->get();

        if (count($category) == 0) {
            abort(404);
        }

        $postClass = 'App\Models\\' . $category[0]['code'];
        $post = $postClass::where('slug', $title)->get();
        if (count($post) == 0) {
            abort(404);
        }

        $post = $post[0];
        $content = $post->content;

        // reformat content
        $formattedContent = [];
        foreach ($content as $item) {
            $formattedContent[$item['title']] = $item['description'];
        }

        $content = $formattedContent;

        return view("PostCategory/{$category[0]['slug']}", ['data' => $post, 'content' => $content],);
    }
}
