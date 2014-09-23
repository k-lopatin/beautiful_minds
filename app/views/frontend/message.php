<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Мозговой штурм</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>

    <!--<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOTFFHfkbIVlNQzCf_Batc4V-WLTzH74c&sensor=TRUE">
    </script>
    <script type="text/javascript" src="assets/frontend/js/google_maps.js"></script>-->
        <script type="text/javascript" src="assets/frontend/js/slider.js"></script>

        <link rel="stylesheet" href="assets/frontend/css/main.css">
    </head>
    <body>
        <?= Form::open(array('url' => '/', 'files' => true)) ?>
        <!--<div id="map_canvas"></div>-->
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
        <div id="top_login">
            <a href="http://citystorm.com/" class="logo">citystorm.com</a>
            <?php
            echo Form::text('email', $email, array('placeholder' => 'E-mail'));
            echo Form::password('password', array('placeholder' => 'Пароль'), $password);
            echo '<input type="submit" value="Войти">';
            echo '<a href="/registration" id="reg_btn"> Регистрация </a>';
            ?>
        </div>

        <div id="container">
            <h1>Мозговой штурм!</h1>
            <ul>
                <li><?=$message?></li>
            </ul>
        </div>

        <?= Form::close() ?>
    </body>
</html>