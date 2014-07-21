<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/assets/admin/css/foundation.css"/>
    <link rel="stylesheet" href="/assets/admin/css/style.css"/>
    <script src="/assets/admin/js/vendor/modernizr.js"></script>
    <title>login</title>

</head>
<body>
<?= Form::open(array('url' => $form_url ) ) ?>
<?= Form::token() ?>
    <div class="row">
        <div class="large-12 columns">
            <?= Form::label('name', 'Логин: ') ?>
            <?= Form::text('name') ?>
            <?= Form::label('password', 'Пароль: ') ?>
            <?= Form::password('password') ?>
            <?= Form::submit( 'Войти', array('class' => 'button') ) ?>
        </div>
    </div>
<?= Form::close() ?>
<script src="/assets/admin/js/vendor/jquery.js"></script>
<script src="/assets/admin/js/foundation.min.js"></script>
<script>
    $(document).foundation();
</script>
</body>
</html>