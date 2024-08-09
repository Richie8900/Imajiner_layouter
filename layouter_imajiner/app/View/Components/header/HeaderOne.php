<?php

namespace App\View\Components\header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Header;

class HeaderOne extends Component
{
    public string $slug = 'header-one';
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header.header-one', ['record' => Header::where('slug', 'header-one')->get()[0], 'content' => Header::where('slug', 'header-one')->get()[0]->content]);
    }
}
