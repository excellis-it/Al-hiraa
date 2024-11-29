<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="{{ $feed->title }}">
    <meta property="og:description" content="{{ $feed->description }}">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">
    <meta name="description" content="{{ $feed->description }}">
    <meta name="twitter:card" content="summary_large_image">
    <title>{{ $feed->title }}</title>
</head>
<body>
    <h1>{{ $feed->title }}</h1>
    <p>{{ $feed->description }}</p>
</body>
</html>
