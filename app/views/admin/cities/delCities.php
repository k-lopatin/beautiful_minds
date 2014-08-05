<?= View::make('admin.header', array('title' => $title)) ?>
<?= Form::open(array('url' => 'admin/cities/del/'.$id)) ?>
<?= Form::token() ?>
    <div class="row">
        <div class="large-12 columns">
            <h4>Удалить город | <a href="/admin/clist?type=city">Все города</a></h4>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <h5>Вы действительно хотите удалить город <br /> <?=$statement;?></h5>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <?= Form::hidden('is', 1) ?>
            <?= Form::submit( 'Да, удалить', array('class' => 'button alert') ) ?>
            <a href="/admin/cities" class="button">Нет, верни меня обратно</a>
        </div>
    </div>

<?= Form::close() ?>
    <div class="row">
        <div class="large-12 columns">
            <h5>Последние города: | <a href="/admin/clist?type=city">Все города</a></h5>
            <table>
                <?php
                    foreach ($questions as $q) {
                        echo '<tr>';
                        echo '<td>Страна:<a href="/admin/cities/' . $q->id . '"> ' . $q->country . ' </a></td>';
                        echo '<td>Город:' . $q->name . ' </td>';
                        echo '</tr>';
                    }
                ?>
            </table>

        </div>
    </div>

<?= View::make('admin.footer') ?>