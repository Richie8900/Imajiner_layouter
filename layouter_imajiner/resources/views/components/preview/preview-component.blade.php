@if ($componentData == null)
<div class="flex p-10 items-center justify-center text-2xl bg-slate-400">
    {{ $category }} not found!
</div>
@else
<div id="script">   
    {!! $componentData->Script !!}
</div>
@endif