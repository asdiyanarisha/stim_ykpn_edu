<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kelola Berita | Dashboard STIM YKPN</title>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="antialiased h-screen overflow-hidden bg-slate-50">
        <div id="app" data-page="news"></div>
    </body>
</html>
<?php /**PATH /home/xau/rasabaik/stim_ykpn_edu/resources/views/news.blade.php ENDPATH**/ ?>