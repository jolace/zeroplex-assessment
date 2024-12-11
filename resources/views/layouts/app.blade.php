<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Task Manager') }}</title>
        <link  rel="stylesheet" type="text/css" href="{{URL::to('/bootstrap/css/bootstrap.min.css')}}"/>
        <link  rel="stylesheet" type="text/css" href="{{URL::to('/custom.css')}}"/>
        <script src="{{URL::to('/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    </head>
    <body>
        <div class="col-lg-8 mx-auto p-3 py-md-5">
            @include('layouts.navigation')
            <main>
                <div class="row g-5">
                    <div class="col-md-12">
                        @yield('content')
                    </div>
                </div>
            </main>
            <footer class="pt-5 my-5 text-muted border-top">
                Zeroplex Assessment - Aleksandar Jolakoski Dec 2024
            </footer>
        </div>
    </body>
</html>
