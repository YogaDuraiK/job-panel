<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        @include('layout.includes.head')
    </head>
    <body>
        @jquery
        @toastr_js
        @toastr_render
        <header>
            @include('layout.nav')
        </header>
        <main>
            @yield('content')
        </main>
        
        @include('layout.includes.foot')
    </body>
</html>