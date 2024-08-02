<div class="grid grid-flow-col gap-3">
    <div class="bg-blue-100 col-span-1">
        <ul>
            @foreach ($componentData as $component)
            <li>
                {{ $component->LayoutName }}
                {{ $component->HeaderName }}    
                {{ $component->FooterName }}
                {{ $component->ComponentName }}
            </li>
            @endforeach
        </ul>
    </div>
    <div class="bg-red-100 col-span-4">2nd col</div>
  </div>