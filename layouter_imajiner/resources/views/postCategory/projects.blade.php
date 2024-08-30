<x-layout.default-layout>
    <x-header.main-navbar/>
    <link rel="stylesheet" href="{{ asset('static/projects-resource/projects.css') }}">

    {{-- Content here --}}
    <div class="w-full flex justify-center items-center">
        <div class="text-5xl">{{ $content['title'] }}</div>
    </div>
    <div class="p-4 m-2 ">
        <div class="text-sm text-gray-400 italic">Date of development: {{ $content['date'] }}</div>
        <div class="text-xl">{{ $content['description'] }}</div>
    </div>
    
    <script src="{{ asset('static/projects-resource/projects.js') }}"></script>
    <x-footer.main-footer/>
</x-layout.default-layout>