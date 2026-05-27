<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kelola Berita | Dashboard STIM YKPN</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased h-screen overflow-hidden bg-slate-50">
        <div id="app" data-page="news"></div>
    </body>
</html>
