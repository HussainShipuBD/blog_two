<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>It's me</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/main.css">
        <script>
            (function () {
                window.Laravel = {
                    csrfToken: '{{ csrf_token() }}'
                };
            })();
        </script>
    </head>
    <body>
        <!-- <div id="app">
            @if(Auth::check())
                <mainapp :user="{{ Auth::user() }}"></mainapp> 
            @else
                <mainapp :user="false"></mainapp> 
            @endif
        </div> -->

        <div id="app">
            <mainapp></mainapp>
        </div>
        <script>
            (function() {
                window.Laravel = {
                    csrfToken: '{{ csrf_token() }}'
                };
                @if(Auth::check())
                    window.authUser = {!! Auth::user() !!}
                @else
                    window.authUser = false
                @endif
            })();
        </script>
    </body>

    <!-- <script src=" mix('/js/app.js')}}"></script> -->
    <script src="/js/app.js"></script>
</html>
