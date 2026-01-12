<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 - Page not found</title>
    <link type='text/css' rel="stylesheet" href="<?= base_url('/assets/bootstrap/css/bootstrap.min.css') ?>">

</head>
<body>
<div class="container">

    <h1>404 - Page not found</h1>
    <?= $error ?? ""; ?>
    <br>
    <a href="/" class="btn btn-info" style="font-size: 18px">На главную страницу</a>

</div>
</body>
</html>