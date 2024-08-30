<x-layout.default-layout>
    <x-header.main-navbar/>
    <link rel="stylesheet" href="{{ asset('static/profile-resource/profile.css') }}">

    {{-- Content here --}}
    <div id="main-content" class="mb-4">
        {{-- <div id="profile">
            <div>Richie Lie Gunawan</div>
            <div></div>
        </div>
        <div> 
            
        </div>--}}
        <div id="education">
            <div class="text-3xl w-4/5 p-4 pb-2 transform transition-transform hover:translate-x-2">
                Education
            </div>
            <div>
                <x-component.profile-education-section/>
            </div>
        </div>
        <div id="experience">
            <div class="text-3xl w-4/5 p-4 pb-2 transform transition-transform hover:translate-x-2">
                Experience
            </div>
            <div>
                <x-component.profile-experience-section/>
            </div>
        </div>
        {{-- <div id="skill">
            <div class="text-3xl w-4/5 p-4 pb-2  transform transition-transform hover:translate-x-2">
                Skill
            </div>
        </div>
        <div id="interest">
            <div class="text-3xl w-4/5 p-4 pb-2  transform transition-transform hover:translate-x-2">
                Interest, Hobby, etc.
            </div>
        </div> --}}
    </div>

    <script src="{{ asset('static/profile-resource/profile.js') }}"></script>
    <x-footer.main-footer/>
</x-layout.default-layout>