<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', 'Admin Dashboard')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite([
            'resources/css/app.css', 
            'resources/js/app.js',
            'resources/css/admin/admin.css',
            'resources/js/admin/admin.js'
            ])
        @stack('styles')
    </head>
    <body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
        <div class="app-wrapper">

            @include('admin.partials.header')
            @include('admin.partials.sidebar')

            <div class="content-wrapper">
                @yield('content')

                <div class="d-flex justify-content-center">
                    @include('admin.partials.footer')
                </div>
            </div>
        </div>
    @include('admin.partials.scripts')
    </body>
</html>
