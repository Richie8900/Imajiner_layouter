<?php

namespace App\View\Components\layout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Layout;

class DefaultLayout extends Component
{
    public $slug = 'default-layout';
    public $record;
    public $content;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->record = Layout::where('slug', 'default-layout')->get()[0]; 
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
        return view('components.layout.default-layout');
    }
}