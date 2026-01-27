<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= get_csrf_meta(); ?>
    <link rel="icon" href="<?= base_url('/images/favicon.ico') ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link type='text/css' rel="stylesheet" href="<?= base_url('/assets/bootstrap/css/bootstrap.min.css') ?>">
    <link type='text/css' rel="stylesheet" href="<?= base_url('/assets/iziModal/css/iziModal.min.css') ?>">
    <link type='text/css' rel="stylesheet" href="<?= base_url('/assets/css/admin.css') ?> ">


    <title>Админка<?= $title ?? ''; ?></title>

    <!----webfonts---->
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
          rel="stylesheet">

</head>
<body class="mainAdminPage">

<!---header---->
    <div class="container">
        <div class="header_nav">
            <div class="header_nav_left">

                <?php if(request()->uri != ''): ?>
                    <a href="<?= base_url('/') ?>" class="dark_btn"><i class="fas fa-caret-left fa-2x"></i> Назад</a>
                <?php endif; ?>

            </div>

            <div class="header_nav_right">
                <a class="dark_btn linkMainPage" href="https://pf54.ru" target="_blank">
                    <img src="/images/common/logo.webp" alt="">
                    Главный сайт
                </a>
                <a href="<?= base_url('/logout') ?>" class="dark_btn"><i class="fas fa-right-from-bracket"></i>Выйти</a>
            </div>
        </div>
            <div class="brand">
                <div class="dot"></div>
                <div class="title">Админка: Главная</div>
            </div>


        <div class="card">
            <nav class="navbar navbar-expand-lg">
                    <div class="collapse navbar-collapse">
                            <a class="dark_btn" href="<?= base_url('/build/create')?>"><i class="fas fa-plus"  style="color: #27ae60"></i>  Создать</a>
                    </div>
                <?php if(request()->uri == ''): ?>
                    <div class="input-group field_find">
                        <input type="text" id="search" class="form-control" placeholder="Search...">
                        <span class="input-group-text" id="clear-search">&times;</span>
                    </div>
                <?php endif; ?>

                    <div class="navbar-expand admin_menu_right">
                        <a class="a_resetId" href="<?= base_url('/service/resetId')?>">resetId</a>
                    </div>
            </nav>
        </div>
        <?php /** @var string $menu */
        if (isset($menu)): echo $menu; endif; ?>

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