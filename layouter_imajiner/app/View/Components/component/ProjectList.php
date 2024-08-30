<?php

namespace App\View\Components\component;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Component as Comp;

use App\Models\Projects;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectList extends Component
{
    public $slug = 'project-list';
    public $record;
    public $content;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->record = Comp::where('slug', 'project-list')->get()[0];
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
        return view('components.component.project-list', ['projects' => Projects::all()]);
    }
}
