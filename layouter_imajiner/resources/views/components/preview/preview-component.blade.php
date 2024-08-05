@if ($componentData == null)
<div class="flex p-10 items-center justify-center text-2xl text-red-600 border">
    {{ $category }} not found!
</div>
@else
{!! $componentData->Script !!}
@endif