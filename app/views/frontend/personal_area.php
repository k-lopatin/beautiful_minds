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
<?= Form::open(array('url' => '/login', 'files' => true)) ?>
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
<div id="top_welcome">
    <div id="login">Привет, <?=Auth::user()->login?></div>
    <div id="exit"><a href="/logout">Выйти</a></div>
</div>

<div id="container">
    <div id="my_cities">
        <h1>Мои города</h1><br>
        <table class="ceny">
        <?php
            foreach ($cities as $c) {
                if($c->is_free == Auth::user()->id )
                {
                    echo '<tr>';
                    echo '<td>' . $c->name . ' </td>';
                    echo '</tr>';
                }
            }
        ?>
        </table>
    </div>
    <div id="avatar">
    </div>
    <div id="go_game">
        <p class="try">Мы подобрали вам случайный город: <span class="city"><?= $random_city ?></span></p>
        <a href="/game" class="try_btn">Завоевать!</a>
    </div>
</div>

<?= Form::close() ?>
</body>
</html>