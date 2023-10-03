<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()"  lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Activity</title>
    @livewireStyles
    @vite(['resources/css/app.css'])
</head>

<body>

    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <x-side-panel />
        <div class="flex flex-col flex-1 w-full">
            <x-top-panel />
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    {{ $slot }}

                </div>
            </main>
        </div>
    </div>



    @livewireScripts
    @vite(['resources/js/app.js'])
</body>

</html>
