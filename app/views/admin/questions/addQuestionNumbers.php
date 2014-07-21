<?= View::make('admin.header', array('title' => $title)) ?>
<?= Form::open(array('url' => 'admin/q_numbers', 'files'=> true )) ?>
<?= Form::token() ?>
    <div class="row">
        <div class="large-12 columns">
            <h4>Добавить вопрос на число | <a href="/admin/qlist?type=number">Все вопросы на числа</a></h4>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <h5><?= $message ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="large-7 columns">
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



            <?= Form::submit('Добавить', array('class' => 'button')) ?>
        </div>

        <?= $filesView ?>
    </div>
<?= Form::close() ?>
    <div class="row">
        <div class="large-12 columns">
            <h5>Последние вопросы: | <a href="/admin/qlist?type=number">Все вопросы</a></h5>
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


    </div>

<?= View::make('admin.footer') ?>