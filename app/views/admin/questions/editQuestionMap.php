<?= View::make('admin.header', array('title' => $title)) ?>
<?php
if($mode == 'add' ){
    echo Form::open( array('url' => 'admin/q_maps', 'files'=> true ) );
} elseif ($mode == 'edit'){
    echo Form::open( array('url' => 'admin/q_maps/'.$id, 'files'=> true ) );
} elseif ($mode == 'del'){
    echo Form::open( array('url' => 'admin/q_maps/del/'.$id, 'files'=> true ) );
}
?>
<?= Form::token() ?>
<?php if($mode == 'add' || $mode == 'edit') { ?>
    <div class="row">
        <div class="large-12 columns">
            <h4>Добавить вопрос на карту | <a href="/admin/qlist?type=map">Все вопросы на картах</a></h4>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <h5><?= $message ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="large-7 columns">
            <?php
            foreach ($mapImgs as $img) {
                echo '<img src="'.$img.'" class="map_little" />';
            }
             ?>
             <div id="map">
             <?php
             if($map != ''){
                echo '<img src="'.$map.'" class="map_big" />';
             }
             ?>
             <img src="/assets/admin/img/circle.png" class="circle" />
             </div>
             <?= Form::hidden('map', $map) ?>

            <?= Form::label('answer', 'Ответ (координаты):') ?>
            <?= Form::text('answer', $answer) ?>

            <?= Form::label('statement', 'Вопрос:') ?>
            <?= Form::textarea('statement', $statement) ?>

            <?= Form::label('error', 'Погрешность:') ?>
            <?= Form::text('error', $error) ?>



            <?= Form::label('complexity', 'Сложность: (от 1 до 10)') ?>
            <?= Form::text('complexity', $complexity) ?>

            <?php
            $cats = [];
            $cats[0] = 'Без категории';
            foreach ($categories as $c) {
                $cats[$c->id] = $c->name;
            }
            $default = isset($category) ? $category : 0;
            echo Form::select('category', $cats, $default);
            ?>

            <?= Form::label('plustime', 'Дополнительное время') ?>
            <?= Form::text('plustime', $plustime) ?>

            <?= Form::label('description', 'Объяснение:') ?>
            <?= Form::textarea('description', $description) ?>

            <?= Form::label('link', 'Ссылка на материал') ?>
            <?= Form::text('link', $link) ?>


            <?php
            if($mode == 'add' ){
                echo Form::submit('Добавить', array('class' => 'button'));
            } elseif ($mode == 'edit'){
                echo Form::submit('Сохранить', array('class' => 'button'));
                echo '<a href="/admin/q_maps" class="button secondary">Добавить новый вопрос</a>';
                echo '<a href="/admin/q_maps/del/'.$id.'" class="button alert">Удалить</a>';
            }
            ?>
        </div>

        <?= $filesView ?>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="large-12 columns">
            <h4>Удалить | <a href="/admin/qlist?type=map">Все вопросы на карты</a></h4>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <h5>Вы действительно хотите удалить вопрос <br /> <?=$statement;?></h5>
        </div>
    </div>
    <div class="row">
        <div class="large-7 columns">
            <?= Form::hidden('is', 1) ?>
            <?= Form::submit( 'Да, удалить', array('class' => 'button alert') ) ?>
            <a href="/admin/q_numbers" class="button">Нет, верни меня обратно</a>
        </div>
    </div>
<?php } ?>
<?= Form::close() ?>
    <div class="row">
        <div class="large-12 columns">
            <h5>Последние вопросы: | <a href="/admin/qlist?type=map">Все вопросы</a></h5>
            <table>
                <?php
                foreach ($questions as $q) {
                    echo '<tr>';
                    echo '<td><a href="/admin/q_maps/' . $q->id . '"> ' . $q->statement . ' </a></td>';
                    echo '<td>Ответ: ' . $q->answer . ' </td>';
                    echo '</tr>';
                }
                ?>
            </table>

        </div>


    </div>
<script src="/assets/admin/js/map.js"></script>

<?= View::make('admin.footer') ?>