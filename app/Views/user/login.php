<div class="container">
    <h1><?= $title ?? ''; ?></h1>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="<?= base_url('/login');?>" method="post" class="ajax-form">

                <?= get_csrf_token(); ?>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control <?= get_validation_class('email')?>" id="email" placeholder="email"  value="<?= old('email') ?>">
                    <?= get_errors('email'); ?>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">password</label>
                    <input name="password" type="password" class="form-control <?= get_validation_class('password')?>" id="password" placeholder="password" value="<?= old('password') ?>">
                    <?= get_errors('password'); ?>
                </div>

                <button type="submit" class="btn btn-warning">Login</button>

            </form>
            <?= session()->remove('form_data'); ?>
            <?= session()->remove('form_errors'); ?>
        </div>
    </div>
</div>
