<?= View::make('admin.header', array('title' => $title)) ?>
<?= Form::open(array('url' => 'admin/q_order/del/'.$id)) ?>
<?= Form::token() ?>
    <div class="row">
        <div class="large-12 columns">
            <h4>Удалить вопрос | <a href="/admin/qlist?type=order">Все вопросы на слова</a></h4>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <h5>Вы действительно хотите удалить вопрос <br /> <?=$statement;?></h5>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <?= Form::hidden('is', 1) ?>
            <?= Form::submit( 'Да, удалить', array('class' => 'button alert') ) ?>
            <a href="/admin/q_order" class="button">Нет, верни меня обратно</a>
        </div>
    </div>

<?= Form::close() ?>
    <div class="row">
        <div class="large-12 columns">
            <h5>Последние вопросы: | <a href="/admin/qlist?type=order">Все вопросы</a></h5>
            <table>
                <?php
                foreach ($questions as $q) {
                    echo '<tr>';
                    echo '<td><a href="/admin/q_oreder/' . $q->id . '"> ' . $q->statement . ' </a></td>';
                    echo '<td>Ответ: ' . $testAnswers[ $q->id ] . ' </td>';
                    echo '</tr>';
                }
                ?>
            </table>

        </div>
    </div>

<?= View::make('admin.footer') ?>