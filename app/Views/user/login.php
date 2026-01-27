<div class="wrap">
    <div class="card">
        <div class="card_header">
            <h1><?= $title ?? ''; ?></h1>
        </div>

        <form action="<?= base_url('/login'); ?>" method="post" class="ajax-form">

            <?= get_csrf_token(); ?>

            <div class="mb-3">
                <label for="email" class="field">Email</label>
                <div class="field-inner">
                    <span class="field-icon">📧</span>
                    <input name="email" type="email" <?= get_validation_class('email') ?>
                    id="email"
                    placeholder="your@mail.com" value="<?= old('email') ?>">
                    <?= get_errors('email'); ?>
                </div>

            </div>
            <div class="mb-3">
                <label for="password" class="field">Password</label>
                <div class="field-inner">
                    <span class="field-icon">🔒</span>
                    <input name="password" type="password" <?= get_validation_class('password') ?>
                    id="password" placeholder="Введите пароль" value="<?= old('password') ?>">
                    <?= get_errors('password'); ?>
                </div>
            </div>

            <button type="submit" class="btn-primary" id="loginBtn">
                <span>Войти</span>
            </button>

        </form>
    </div>

</div>
