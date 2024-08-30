<x-layout.default-layout>
    <x-header.main-navbar/>
    <link rel="stylesheet" href="{{ asset('static/projects-resource/projects.css') }}">

    {{-- Content here --}}
    <div id="main-content"
    class="m-2 p-2">
        <div>
            <x-component.project-list/>
        </div>
    </div>

    <script src="{{ asset('static/projects-resource/projects.js') }}"></script>
    <x-footer.main-footer/>
</x-layout.default-layout>