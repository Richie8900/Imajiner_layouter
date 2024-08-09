<?php

namespace App\View\Components\header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Header;

class HeaderFour extends Component
{
    public $slug = 'header-four';
    public $record;
    public $content;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->record = Header::where('slug', 'header-four')->get()[0]; 
        $this->content = $this->record['content'];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header.header-four');
    }
}