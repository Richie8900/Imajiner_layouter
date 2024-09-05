<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Layouter</title>
    @vite('resources/css/app.css')
    <style>
    </style>
</head>
<body class="h-screen flex items-center justify-center">
    <div class="w-full">
        <div id="title" class="text-4xl text-center p-4 pb-0">Welcome to Layouter</div>
        <div id="title" class="text-lg text-center">An unofficial laravel extension to help with developing</div>
        <div class="flex p-4 px-1">
            <a href="https://shiny-mayonnaise-aee.notion.site/Documentation-93cfe3e29b4049549ec13118da31eb77#d17bba92e5be42a49d9fff0b9eff899e" 
            class="w-1/2 bg-black rounded-lg p-4 m-3 mr-0 transform transition-transform scale-95 hover:scale-100 text-white">
                <div class="text-2xl mb-1">Documentation</div>
                What we have added and their uses
            </a>
            <a href="https://shiny-mayonnaise-aee.notion.site/User-Guide-ef9d4d4dc9aa4882a1eb0523dee66783#c97a4d2d475f47b281e78d43bb6d5272" 
            class="w-1/2 bg-black rounded-lg p-4 m-3 mx-0 transform transition-transform scale-95 hover:scale-100 text-white">
                <div class="text-2xl mb-1">User Guide</div>
                Suggested flow for using layouter
            </a>
            <a href="/admin" 
            class="w-1/2 bg-black rounded-lg p-4 m-3 ml-0 transform transition-transform scale-95 hover:scale-100 text-white">
                <div class="text-2xl mb-1">Start Developing!</div>
                Go to admin →
            </a>
        </div>
    </div>

    <a href="/rebirth" class="absolute right-0 bottom-0 hidden">a</a>
</body>
</html>