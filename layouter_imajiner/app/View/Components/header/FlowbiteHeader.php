<?php

namespace App\View\Components\header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Header;

class FlowbiteHeader extends Component
{
    public $slug = 'flowbite-header';
    public $record;
    public $content;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->record = Header::where('slug', 'flowbite-header')->get()[0]; 
        $this->content = $this->record['content'];
        // reformat content
        $formattedContent = [];
        foreach ($this->content as $item) {
            $formattedContent[$item['title']] = $item['description'];
        }
        $this->content = $formattedContent;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header.flowbite-header');
    }
}