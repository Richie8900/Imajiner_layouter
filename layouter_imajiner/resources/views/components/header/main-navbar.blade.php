<link rel="stylesheet" href="{{ asset('static/header/main-navbar-resource/main-navbar.css') }}">

<div id="main-header" class="m-2 p-2 bg-black rounded-md flex flex-row">
    <div class="w-1/2 text-left text-white text-4xl">
        <a href="/home">Richie.</a>
    </div>
    <div class="w-1/2 text-white flex items-center justify-end">
        <a href="/profile"
        class=" text-xl px-3 relative text-white cursor-pointer transition-all ease-in-out before:transition-[width] before:ease-in-out before:duration-700 before:absolute before:bg-gray-400 before:origin-center before:h-[1px] before:w-0 hover:before:w-[50%] before:bottom-0 before:left-[50%] after:transition-[width] after:ease-in-out after:duration-700 after:absolute after:bg-gray-400 after:origin-center after:h-[1px] after:w-0 hover:after:w-[50%] after:bottom-0 after:right-[50%]">
            Profile
        </a>
        <a href="/project" 
        class=" text-xl px-3 relative text-white cursor-pointer transition-all ease-in-out before:transition-[width] before:ease-in-out before:duration-700 before:absolute before:bg-gray-400 before:origin-center before:h-[1px] before:w-0 hover:before:w-[50%] before:bottom-0 before:left-[50%] after:transition-[width] after:ease-in-out after:duration-700 after:absolute after:bg-gray-400 after:origin-center after:h-[1px] after:w-0 hover:after:w-[50%] after:bottom-0 after:right-[50%]">
            Projects
        </a>
    </div>
</div>

<script src="{{ asset('static/header/main-navbar-resource/main-navbar.js') }}"></script>