<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('images/book.ico') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>SimpleBlog - Example SPA with Laravel 5.4 and Vue.js 2</title>
</head>
<body>

@yield('content')

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 pull-right text-right">
                <h6>Created by Antesko</h6>
            </div>
        </div>
    </div>
</footer>

@include('layouts.scripts')

</body>
</html>