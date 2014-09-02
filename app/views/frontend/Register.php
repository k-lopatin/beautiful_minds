<?= Form::open(array('url' => 'game/registration', 'files'=> true )) ?>
<?= Form::token() ?>
    <div class="row">
        <div class="large-7 columns">
            <?= Form::label('name', 'Имя:') ?>
            <?= Form::textarea('name', $name) ?>

            <?= Form::label('login', 'Логин:') ?>
            <?= Form::text('login', $login) ?>

            <?= Form::label('email', 'E-mail') ?>
            <?= Form::text('email', $email) ?>

            <?= Form::label('password', 'Пароль') ?>
            <?= Form::text('password', $password) ?>

            <?= Form::submit('Зарегистрироваться', array('class' => 'button')) ?>
        </div>

    </div>
<?= Form::close() ?>
