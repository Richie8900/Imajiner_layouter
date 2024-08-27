<?php

namespace App\View\Components\Preview;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Layout;
use App\Models\Header;
use App\Models\Footer;
use App\Models\Component as Comp;

class PreviewComponent extends Component
{
    public $componentData;
    /**
     * Create a new component instance.
     */
    public function __construct(public $category, public $id)
    {
        if ($category == 'layout') {
            $this->componentData = Layout::find($id);
        } else if ($category == 'header') {
            $this->componentData = Header::find($id);
        } else if ($category == 'footer') {
            $this->componentData = Footer::find($id);
        } else if ($category == 'component') {
            $this->componentData = Comp::find($id);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.preview.preview-component');
    }
}
