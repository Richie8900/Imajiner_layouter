@if ($componentData == null)
<div class="h-screen flex items-center justify-center text-2xl">
    Data not found!
</div>
@else
<div id="script">   
    {!! $componentData->Script !!}
</div>
@endif