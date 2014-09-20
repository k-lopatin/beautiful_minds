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
        <script type="text/javascript" src="assets/frontend/js/main.js"></script>
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

        <div id="container">
            <div id="rating">
                <h1>Рейтинг</h1><br>
                <table class="ceny">
                    <?php
                    $players = Player::orderBy('Points', 'desc')->get();
                    $i = 1;
                    echo '<tr>';
                    echo '<th id = "one">Место</td>';
                    echo '<th id = "second">Логин</td>';
                    echo '<th id = "third">Очки</td>';
                    echo '</tr>';
                    foreach($players as $p)
                    {
                        echo '<tr>';
                        echo '<td id = "one">' . $i . ' </td>';
                        echo '<td id = "second">' . $p->login . ' </td>';
                        echo '<td id = "third">' . $p->Points . ' </td>';
                        echo '</tr>';
                        $i++;
                    }
                    ?>
                </table>
            </div>
        </div>

    <?= Form::close() ?>
    </body>
</html>