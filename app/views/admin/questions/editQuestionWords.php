<?= View::make('admin.header', array('title' => $title)) ?>
<?= Form::open(array('url' => 'admin/q_words/'.$id)) ?>
<?= Form::token() ?>
    <div class="row">
        <div class="large-12 columns">
            <h5><?= $message ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <?= Form::label('statement', 'Вопрос:') ?>
            <?= Form::textarea('statement', $statement) ?>

            <?= Form::label('answer', 'Ответ:') ?>
            <?= Form::text('answer', $answer) ?>

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

            <?= Form::submit('Сохранить', array('class' => 'button')) ?>
            <a href="/admin/q_words" class="button secondary">Добавить новый вопрос</a>
            <a href="/admin/q_words/del/<?=$id?>" class="button alert">Удалить</a>
        </div>
    </div>
<?= Form::close() ?>
    <div class="row">
        <div class="large-8 columns">
            <h5>Вопросы на слова:</h5>
            <table>
                <?php
                foreach ($questions as $q) {
                    echo '<tr>';
                    echo '<td><a href="/admin/q_words/' . $q->id . '"> ' . $q->statement . ' </a></td>';
                    echo '<td>Ответ: ' . $q->answer . ' </td>';
                    echo '</tr>';
                }
                ?>
            </table>

        </div>
        <div class="large-4 columns">
            <h5>Просмотреть вопросы из категории:</h5>
            <ul>
                <li><a href="/admin/q_words/cat/0">Без категории</a></li>
                <?php
                foreach ($categories as $c) {
                    echo '<li><a href="/admin/q_words/cat/' . $c->id . '"> ' . $c->name . ' </a></li>';
                }
                ?>
            </ul>

        </div>
    </div>

<?= View::make('admin.footer') ?>