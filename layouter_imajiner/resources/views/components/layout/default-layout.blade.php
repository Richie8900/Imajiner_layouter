<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portofolio</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('static/layout/default-layout-resource/default-layout.css') }}">
</head>
<body class="font-body">

{{ $slot }}

<script src="{{ asset('static/layout/default-layout-resource/default-layout.js') }}"></script>
</body>
</html>