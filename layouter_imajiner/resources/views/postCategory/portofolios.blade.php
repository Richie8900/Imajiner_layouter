<x-layout.default-layout>
        <x-header.flowbite-header/>
        <link rel="stylesheet" href="{{ asset('static/portofolios-resource/portofolios.css') }}">

        {{-- Content here --}}
       @dd($content)

        <script src="{{ asset('static/portofolios-resource/portofolios.js') }}"></script>
        <x-footer.flowbite-footer/>
</x-layout.default-layout>