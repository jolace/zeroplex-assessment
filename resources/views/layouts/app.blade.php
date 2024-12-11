<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
    </head>
    <body class="d-flex flex-column min-vh-100">
        <div class="col-lg-8 mx-auto p-3 py-md-5 flex-grow-1">
            @include('layouts.navigation')
            <main>
                <div class="row g-5">
                    <div class="col-md-12">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
        <footer class="pt-5 my-5 text-muted border-top text-center">
            Zeroplex Assessment - Aleksandar Jolakoski Dec 2024
        </footer>
</body>
</html>
