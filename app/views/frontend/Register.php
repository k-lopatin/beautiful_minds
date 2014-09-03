


<link rel="stylesheet" href="/assets/admin/css/foundation.css"/>
<link rel="stylesheet" href="/assets/frontend/css/main.css">
<link rel="stylesheet" href="/assets/game/css/main.css">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>

<script type="text/javascript" src="../assets/frontend/js/main.js"></script>
<script type="text/javascript" src="../assets/frontend/js/slider.js"></script>

<div id="slideshow">
    <div class="slide">
        <img src="/assets/frontend/img/p1.jpg">
    </div>
    <div class="slide">
        <img src="/assets/frontend/img/p2.jpg">
    </div>
    <div class="slide">
        <img src="/assets/frontend/img/p3.jpg">
    </div>
    <div class="slide">
        <img src="/assets/frontend/img/p4.jpg">
    </div>
</div>
<div id="registration">
    <?= Form::open(array('url' => 'game/registration')) ?>
    <?= Form::token() ?>

    <?= Form::text('name', $name, array('placeholder' => 'Имя')) ?>

    <?= Form::text('login', $login, array('placeholder' => 'Логин')) ?>

    <?= Form::text('email', $email, array('placeholder' => 'E-mail')) ?>

    <?= Form::password('password', $password, array('placeholder' => 'Пароль')) ?>

    <?= Form::submit('Зарегистрироваться', array('class' => 'button')) ?>
    <?= Form::close() ?>

</div>


