<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $heading }}</title>
    <link rel="stylesheet" href="{{ asset('css/main_index.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{ $slot }}

</body>
</html>
