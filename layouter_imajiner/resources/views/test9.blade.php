<x-layout.example-layout 
    tag="{{ $data->PageName }}">
    <x-header.example-header title="{{ $data->PageName }}" />
    {{-- Separator --}} 
    
    {{-- Content here, you can delete this comment but please don't delete the 'Separator' comment, as it is used to mark where your content starts in order to save it from the filament page thanks! --}}
    {{-- @dd($page->PageName) --}}
    <div class="text-3xl font-bold underline">content</div>
    content

    {{-- Separator --}} 
    <x-footer.example-footer />
</x-layout.example-layout>