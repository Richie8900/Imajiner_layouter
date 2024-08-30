<link rel="stylesheet" href="{{ asset('static/component/project-list-resource/project-list.css') }}">

<ul>
    @foreach ($projects as $p)
        <li class="text-2xl "> 
            <a href="/projects/{{ $p['slug'] }}">{{ $p['title'] }}</a>
        </li>
    @endforeach
</ul>

<script src="{{ asset('static/component/project-list-resource/project-list.js') }}"></script>