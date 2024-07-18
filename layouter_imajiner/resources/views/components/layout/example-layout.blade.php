<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- CSS file --}}
    <link rel="stylesheet" href="{{ asset('static/' . $tag.'-resource/'.$tag.'.css') }}">
</head>


<body>

    <div id="content">

        {{ $slot }}

    </div>

    {{-- JS file --}}
    <script src="{{ asset('static/' . $tag . '-resource/' . $tag. '.js') }}"></script>
    
</body>

</html>