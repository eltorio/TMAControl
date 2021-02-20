<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TMA') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased bg-gray-100 flex flex-col h-screen justify-between">
        

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <div  class="flex-1 h-full">
                {{ $slot }}
                </div>
            </main>
            @if (!Request::is('login*') && !Request::is('register*'))
                <footer class='flex w-full mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-white shadow justify-between'>
                    <div>
                        <a href="https://www.highcanfly.club" class="text-sm text-gray-700 ">© High Can Fly 2021</a> 
                    </div>
                    <div>
                        @if (isset($footer))
                            {{ $footer }}
                        @endif
                    </div>
                    <div>
                        @if (!Auth::user())
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">{{__('Login')}}</a>&nbsp;
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">{{__('Register')}}</a>   
                        @else
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                        <a href="{{ route('logout') }}" class="text-sm text-gray-700 underline" onclick="event.preventDefault(); this.closest('form').submit();">{{__('Logout')}}</a>
                        </form>
                        @endif
                    </div>
                </footer>
            @endif
        @stack('modals')

        @livewireScripts
    </body>
</html>
