<x-layout.default-layout>
        <x-header.flowbite-header/>
        <link rel="stylesheet" href="{{ asset('static/articles-resource/articles.css') }}">

        {{-- Content here --}}
        <div>
                {{$content['title']}}
        </div>
        <div>
                {{$content['content']}}
        </div>

        <script src="{{ asset('static/articles-resource/articles.js') }}"></script>
        <x-footer.flowbite-footer/>
</x-layout.default-layout>