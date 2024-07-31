<x-layout.test-layout>
    <x-header.test-header title='Insert Title Here'/>
    <link rel="stylesheet" href="{{ asset('static/about-resource/about.css') }}">

    <div class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-lg flex items-center space-x-4">
        <div class="shrink-0">
            <div>logo</div>
        </div>
        <div>
            <div class="text-xl font-medium text-white bg-black">ChitChat</div>
            <p class="text-slate-500">You have a new message!</p>
        </div>
    </div>

    <script src="{{ asset('static/about-resource/about.js') }}"></script>
    <x-footer.test-footer/>
</x-layout.test-layout>