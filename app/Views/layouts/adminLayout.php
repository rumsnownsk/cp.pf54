<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= get_csrf_meta(); ?>
    <link rel="icon" href="<?= base_url('/images/favicon.ico') ?>">

    <link type='text/css' rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link type='text/css' rel="stylesheet" href="<?= base_url('/assets/bootstrap/css/bootstrap.min.css') ?>">
    <link type='text/css' rel="stylesheet" href="<?= base_url('/assets/iziModal/css/iziModal.min.css') ?>">
    <link type='text/css' rel="stylesheet" href="<?= base_url('/assets/css/admin.css') ?> ">


    <title>Админка<?= $title ?? ''; ?></title>

    <!----webfonts---->
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
          rel="stylesheet">

</head>
<body>

<!---header---->
<header id="header" class="header">
    <div class="container">
        <div class="headerLine">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <div class="navbar-brand">Админка</div>

                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link active" aria-current="page" href="<?= base_url('/')?>">Главная</a>
                            <a class="nav-link" href="<?= base_url('/')?>">Весь список</a>
                            <a class="nav-link" href="<?= base_url('/build/create')?>">Создать</a>
                        </div>
                    </div>
                    <div class="input-group field_find">
                        <input type="text" id="search" class="form-control" placeholder="Search...">
                        <span class="input-group-text" id="clear-search">&times;</span>
                    </div>
                    <div class="navbar-expand admin_menu_right">
                        <a class="a_logout" href="<?= base_url('/logout')?>">logout</a>
                        <a class="a_resetId" href="<?= base_url('/service/resetId')?>">resetId</a>
                    </div>
                </div>
            </nav>
        </div>
        <?php /** @var string $menu */
        if (isset($menu)): echo $menu; endif; ?>

</header>
<!---//end_header---->

<?php get_alerts(); ?>

<!---content---->
<section id="content" class="content">
    <?= /** @var string $content */
    $content; ?>
</section>
<!---//end_content---->


<!---footer---->
<footer id="footer" class="footer">
    <div class="container">

    </div>
</footer>
<!---//end_footer---->


<?php //if (!empty($footer_scripts)) : ?>
<!--    --><?php //foreach ($footer_scripts as $footer_script) : ?>
<!--        <script src="--><? //= $footer_script ?><!--"></script>-->
<!--    --><?php //endforeach; ?>
<?php //endif; ?>

<script type="text/javascript" src="<?= base_url('/assets/js/jquery-3.7.1.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('/assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('/assets/iziModal/js/iziModal.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('/assets/js/admin.js') ?>"></script>

<div class="iziModal-alert-success"></div>
<div class="iziModal-alert-error"></div>
</body>
</html>