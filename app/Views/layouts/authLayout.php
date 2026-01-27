<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?= base_url('/images/favicon.ico') ?>">

    <link type='text/css' rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type='text/css' rel="stylesheet" href="<?= base_url('/assets/bootstrap/css/bootstrap.min.css') ?>">
    <link type='text/css' rel="stylesheet" href="<?= base_url('/assets/iziModal/css/iziModal.min.css') ?>">
<!--    <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">-->
    <link type='text/css' rel="stylesheet" href="<?= base_url('/assets/css/mobile-menu.css') ?>">
    <link type='text/css' rel="stylesheet" href="<?= base_url('/assets/css/login.css') ?>">

    <meta name="geo.placename" content="Новосибирск, Россия"/>
    <meta name="geo.region" content="RU-NS"/>

    <title>Паспорт Фасадов<?php echo $title ?? ''; ?></title>

    <!----webfonts---->
<!--    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"-->
<!--          rel="stylesheet">-->

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Segoe+UI&display=swap" rel="stylesheet">

</head>
<body class="bg-orbits">




</header>
<!---//end_header---->

<?php get_alerts(); ?>

<!---content---->
<!--<section id="content" class="content">-->
    <?= /** @var string $content */
    $content; ?>
<!--</section>-->
<!---//end_content---->


<!---footer---->
<footer id="footer" class="footer">
    <div class="container">

    </div>
</footer>
<!---//end_footer---->



<script type="text/javascript" src="<?= base_url('/assets/js/jquery-3.7.1.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('/assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('/assets/iziModal/js/iziModal.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('/assets/js/main.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('/assets/js/mobile_menu.js') ?>"></script>
<script>
    (function () {
        var btn = document.getElementById('loginBtn');
        if (!btn) return;
        btn.addEventListener('mousemove', function (e) {
            var r = btn.getBoundingClientRect();
            var x = e.clientX - r.left;
            var y = e.clientY - r.top;
            btn.style.setProperty('--mx', x + 'px');
            btn.style.setProperty('--my', y + 'px');
        });
    })();
</script>
<div class="iziModal-alert-success"></div>
<div class="iziModal-alert-error"></div>
</body>
</html>