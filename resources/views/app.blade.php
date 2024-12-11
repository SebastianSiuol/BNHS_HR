<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    @viteReactRefresh
    @vite('resources/js/app.jsx')
    @routes
    @inertiaHead
</head>
<body>
    @inertia
    <div id="portal"></div>
</body>
</html>
