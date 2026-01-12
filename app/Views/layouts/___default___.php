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
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type='text/css' rel="stylesheet" href="<?= base_url('/assets/bootstrap/css/bootstrap.min.css') ?>">
    <link type='text/css' rel="stylesheet" href="<?= base_url('/assets/iziModal/css/iziModal.min.css') ?>">
<!--    <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">-->
    <link type='text/css' rel="stylesheet" href="<?= base_url('/assets/css/mobile-menu.css') ?>">
    <link type='text/css' rel="stylesheet" href="<?= base_url('/assets/css/main.css') ?>">

    <meta name="description"
          content="Разработка согласование и получение паспортов фасадов зданий в Новосибирске и других городах">
    <meta name="keywords"
          content="паспорт фасадов, получение паспорта фасадов, Федеральный Закон №131, Решение совета депутатов №647 от 03.03.2021">

    <meta name="geo.position" content="55.019738, 82.924095"/>
    <meta name="geo.placename" content="Новосибирск, Россия"/>
    <meta name="geo.region" content="RU-NS"/>

    <title>Паспорт Фасадов<?php echo $title ?? ''; ?></title>

    <!----webfonts---->
<!--    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"-->
<!--          rel="stylesheet">-->

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Segoe+UI&display=swap" rel="stylesheet">

</head>
<body>
<!---header---->
<header id="header" class="header">
    <div class="container">
        <div class="headerLine">
            <div class="header__logo">
                <img src="/images/common/logo.png" class="logo" alt="паспорт фасадов"
                     title="Паспорт фасада новосибирск"/>
            </div>
            <div class="header__info">
                <h1 class="">паспорт фасадов</h1>
                <p>Разработка. Согласование. Получение</p>
            </div>
            <div class="header__contact">
                <div class="headerLocation">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span>г.Новосибирск <br> Красный пр-т 14, оф.703</span>
                </div>
                <div><i class="fa fa-phone" aria-hidden="true"></i><span>223-77-49</span></div>
                <div><i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <span>
                            <a href="mailto:pfnsk@list.ru?subject=У_меня_вопрос"
                               style="color:#FF6600;">pfnsk@list.ru</a>
                    </span>
                </div>
                <div><i class="fa fa-mobile" aria-hidden="true"></i><span>+7-913-944-8850</span></div>
                <div class="social-contact">
                    <a href="https://wa.me/79139448850?text=Здравствуйте! У меня вопрос" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                    <a href="https://t.me/+79139448850" target="_blank"><i class="fa fa-telegram" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>

        <!--Кнопка-->
        <button class="menu__bnt" id="mobile-menu-btn">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="menu">
            <?php /** @var string $menu */
            if (isset($menu)): echo $menu; endif; ?>
        </div>

        <!--Мобильное меню-->
        <div class="mobile-menu" id="mobile-menu">
            <div class="mm__bg mm__close"></div>
            <div class="mm__wrapper" id="mm__wrapper">
                <ul>
                    <li class="menu__item"><a href="<?= base_url('/') ?>">главная</a></li>
                    <li class="menu__item"><a href="<?= base_url('/law') ?>">закон</a></li>
                    <li class="menu__item"><a href="<?= base_url('/works') ?>">готовые паспорта</a></li>
                    <li class="menu__item"><a href="<?= base_url('/procedure') ?>">порядок получения паспорта</a>
                    </li>
                    <li class="menu__item"><a href="<?= base_url('/service') ?>">дополнительные услуги</a></li>
                    <li class="menu__item"><a href="<?= base_url('/contacts') ?>">контакты</a></li>
                </ul>
            </div>
        </div>

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

<script type="text/javascript" src="<?= base_url('/assets/js/jquery-3.7.1.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('/assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('/assets/iziModal/js/iziModal.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('/assets/js/main.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('/assets/js/mobile_menu.js') ?>"></script>

<div class="iziModal-alert-success"></div>
<div class="iziModal-alert-error"></div>
</body>
</html>