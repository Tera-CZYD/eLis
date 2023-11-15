<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eLIS Demo</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    
    <!-- <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/styles.css') }}">
    <link href="{{ asset('datatables/datatables.min.css') }}" rel="stylesheet">
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.min.js') }}"></script>
    <!-- <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.min.js') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js') }}"> -->
    @vite(['resources/js/app.js'])
</head>
<body>
        
        <div id="app"></div>
        <script src="{{ asset('temp/scripts.js') }}"></script>
        <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('datatables/datatables.min.js') }}"></script>
</body>
</html>