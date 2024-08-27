<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AddAppViewVar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:appView {name} {component} {location}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $slug = Str::slug($name);
        $formattedName = str_replace(' ', '', $name);
        $component = $this->argument('component');
        $model = ucfirst($component);
        $loc = $this->argument('location');

        if (!File::exists(app_path($loc))) {
            $this->error("$loc does not exist");
            return;
        }

        if ($component == 'view') {
            $view = $slug;
        } else {
            $view = "components." . $component . "." . $slug;
        }

        $script = "<?php

namespace App\View\Components\\$component;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\\$model;

class $formattedName extends Component
{
    public " . '$slug' . " = '$slug'" . ";
    public " . '$record' . ";
    public " . '$content' . ";
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        " . '$this->record' . " = $model::where('slug', '$slug')->get()[0]; 
        " . '$this->content' . " = " . '$this->record' . "['content'];
        // reformat content
        " . '$formattedContent' . " = [];
        foreach (" . '$this->content' . " as " . '$item' . ") {
            " . '$formattedContent[$item' . "['title']] = " . '$item' . "['description'];
        }
        " . '$this->content' . " = " . '$formattedContent' . ";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('$view');
    }
}";

        if ($model == 'Component') {
            $script = "<?php

namespace App\View\Components\\$component;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Component as Comp;

class $formattedName extends Component
{
    public " . '$slug' . " = '$slug'" . ";
    public " . '$record' . ";
    public " . '$content' . ";
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        " . '$this->record' . " = Comp::where('slug', '$slug')->get()[0]; 
        " . '$this->content' . " = " . '$this->record' . "['content'];
        // reformat content
        " . '$formattedContent' . " = [];
        foreach (" . '$this->content' . " as " . '$item' . ") {
            " . '$formattedContent[$item' . "['title']] = " . '$item' . "['description'];
        }
        " . '$this->content' . " = " . '$formattedContent' . ";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('$view');
    }
}";
        }
        File::put(app_path($loc), $script);
        $this->info("script successfully replaced");
    }
}
