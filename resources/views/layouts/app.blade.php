<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        {{-- toastr library for browser dispatch events --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"  />
       
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
     
        <x-banner />

        <div class="min-h-screen bg-gray-100">
       
            @livewire('navigation-menu')

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
                {{ $slot }}
            </main>
              @include('layouts.partials._footer')
        </div>

        @stack('modals')

        {{-- toastr library for browser dispatch events --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>

         $(document).ready(function(){
            toastr.options={
            'progressBar':true,
            'positionClass':"toast-bottom-right",
             };
         });
         
        window.addEventListener('success', event => {
            toastr.success(event.detail.message);
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail.message);
        });
        window.addEventListener('info', event => {
            toastr.info(event.detail.message);
        });
        window.addEventListener('warning', event => {
            toastr.warning(event.detail.message);
        });

        </script>

        {{-- toastr library ends here--}}

        @livewireScripts
    </body>
</html>
