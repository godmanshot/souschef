<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="app-url" content="{{url('/')}}">

        <title>Меню</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>

            <div class="alux-menu-builder">
                
            </div>

            <div id="example"></div>
            
            <script src="{{asset(mix('js/app.js'))}}"></script>
            <link rel="stylesheet" href="{{asset(mix('css/app.css'))}}">
    </body>
</html>
