<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield ('title')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/stylez.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

</head>
<body>

<div class="container">

    @include ('website::parts.top-nav')

    @include ('website::parts.main-menu')

    @yield ('content')

</div>

</body>
</html>
