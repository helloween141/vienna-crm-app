<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{env('APP_NAME')}}</title>
    <!-- Scripts and CSS import -->
    @vite
</head>
<body class="dark:bg-gray-900">
<div id="app"></div>
</body>
</html>
