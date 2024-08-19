<x-layout.default-layout>
    <x-header.flowbite-header/>
    <link rel="stylesheet" href="{{ asset('static/page-resource/page.css') }}">

    {{-- Content here --}}
    <h1>{{$content['title']}}</h1>

    <script src="{{ asset('static/page-resource/page.js') }}"></script>
    <x-footer.flowbite-footer/>
</x-layout.default-layout>