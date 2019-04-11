<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>hm2</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        
    </head>
    <body>
        @include('inc.navbar')
        @include('inc.messages')
        <div class="container">
            <div class="heading">
            @yield('heading')
            </div>
            <div class="content">
            @yield('content')
            </div>
            <div class="footer">@yield('footer')</div>
            </div>
    </body>
</html>