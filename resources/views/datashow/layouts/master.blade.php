<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Datashow') }}</title>
</head>

<body class = "container-fluid">

<a type="button" href="{{ route('showModelData', 'User') }}" target="_blank">Show Model data</a>
<a type="button" href="{{ route('getModelData', 'User') }}" target="_blank">Get Model data</a>

<!-- MAIN PANEL -->
<div id="main" role="main">
    @yield('main_content')
</div>

@stack('scripts')

</body>

</html>