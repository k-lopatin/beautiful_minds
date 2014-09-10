<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Разбуди интелект! | Мозговой штурм?</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>

    <!--<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOTFFHfkbIVlNQzCf_Batc4V-WLTzH74c&sensor=TRUE">
    </script>
    <script type="text/javascript" src="assets/frontend/js/google_maps.js"></script>-->
        <script type="text/javascript" src="../assets/frontend/js/main.js"></script>
        <script type="text/javascript" src="../assets/frontend/js/slider.js"></script>
        <script type="text/javascript" src="../assets/game/js/game.js"></script>

        <link rel="stylesheet" href="../assets/frontend/css/main.css">
        <link rel="stylesheet" href="../assets/game/css/main.css">
    </head>
    <?= Form::open(array('url' => '/registration', 'files' => true)) ?>
    <?= Form::token() ?>
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
        <div class="row">
            <div class="large-12 columns">
                <h3><?= $message ?></h3>
            </div>
        </div>
        <?= Form::text('name', $name, array('placeholder' => 'Имя')) ?>
        <?= Form::text('login', $login, array('placeholder' => 'Логин')) ?>
        <?= Form::text('email', $email, array('placeholder' => 'E-mail')) ?>

        <?= Form::password('password', array('placeholder' => 'Пароль'), $password) ?>
        <?= Form::submit('Зарегистрироваться', array('class' => 'button')) ?>
        <?= Form::close() ?>

    </div>


