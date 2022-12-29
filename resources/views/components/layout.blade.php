<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="{{ asset('css/drag.css') }}">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/drag.js') }}"></script>
        <script src="{{ asset('js/edit.js') }}"></script>
    </head>
    <body class="bg-gray-200">
        <div class="mx-auto py-8 px-6 bg-white  rounded-xl h-screen flex flex-col justify-between">
            <h1 class="font-bold text-5xl text-center mb-8">
                Task Management
            </h1>
            <div class="flex-1 bg-gray-50 overflow-auto rounded-xl">
                @error('name')
                    <p class="text-red-500 text-md pl-5 mt-1">
                        {{ $message }}
                    </p>
                @enderror
                <main class="h-full p-3 inline-flex space-x-2">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>