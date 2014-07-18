<?= View::make('admin.header', array('title' => $title)) ?>
<?= Form::open(array('url' => 'admin/q_numbers/del/'.$id)) ?>
<?= Form::token() ?>
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

<?= Form::close() ?>
    <div class="row">
        <div class="large-8 columns">
            <h5>Вопросы на числа:</h5>
            <table>
                <?php
                foreach ($questions as $q) {
                    echo '<tr>';
                    echo '<td><a href="/admin/q_numbers/' . $q->id . '"> ' . $q->statement . ' </a></td>';
                    echo '<td>Ответ: ' . $q->answer . ' </td>';
                    echo '</tr>';
                }
                ?>
            </table>

        </div>
        <div class="large-4 columns">
            <h5>Просмотреть вопросы из категории:</h5>
            <ul>
                <li><a href="/admin/q_numbers/cat/0">Без категории</a></li>
                <?php
                foreach ($categories as $c) {
                    echo '<li><a href="/admin/q_numbers/cat/' . $c->id . '"> ' . $c->name . ' </a></li>';
                }
                ?>
            </ul>

        </div>
    </div>

<?= View::make('admin.footer') ?>