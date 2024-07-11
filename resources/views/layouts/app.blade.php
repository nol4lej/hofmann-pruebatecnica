<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @include('layouts.includes.head')
        @include('layouts.includes.scripts')

        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>

        @include('components.nav')

        {{ $slot }}
        
        @include('components.footer')

    </body>
</html>
